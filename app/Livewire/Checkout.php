<?php

namespace App\Livewire;

use App\Livewire\Checkouts\AccountWith;
use App\Models\Rifas\Sales\Sale;
use App\Services\Mp\MercadoPagoConfig;
use App\Services\Onixpay\Customer;
use App\Services\Onixpay\Pix;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Notifications\Notification;
use Illuminate\Support\HtmlString;

class Checkout extends FormsComponent
{
    use AccountWith;

    public ?array $data = [];

    public $sale;

    public $rifa;

    protected $authService;


    public function mount(Sale $sale): void
    {
        if (!auth()->check()) {
            return;
        }

        $user = auth()->user();
        $user->load('address');
        $this->form->fill($user->toArray());
        $this->sale = $sale;

        $this->sale->discount = $this->discount();
        $this->sale->subtotal = $this->subtotal();
        $this->sale->total = $this->total();
        $this->sale->save();
        $this->rifa = $sale->rifa;
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('account')
                        ->label('Minha Conta')
                        ->afterValidation(function ($state) {
                            auth()->user()->update([
                                'document' => $state['document'],
                                'phone' => $state['phone'],
                            ]);
                        })
                        ->schema($this->getAccountSchema()),
                    Step::make('address')
                        ->label('Endereço')
                        ->statePath('address')
                        ->afterValidation(function ($state) {
                            $this->getAccountAddressAfterValidation($state);
                        })
                        ->schema($this->getAccountAddressSchema())->columns(6),
                    Step::make('payment')
                        ->label('Pagamento')
                        ->schema([

                            Fieldset::make('pix')->schema($this->getAccountPixSchema())
                                ->label('Pix')
                            // ->visible(fn ($get): bool => $get('payment_method') === 'pix'),
                        ]),
                ])
                    ->submitAction(new HtmlString(view('components.checkout-submit'))),
                //  ->startOnStep(3)
            ])
            ->statePath('data');
    }

    public function submit(): mixed
    {
        $data = $this->form->getState();

        $user = auth()->user();


        if (!$user->customer) {
            // $this->createCustomer($user, $data);
        }

        $res = false;

        // $res = $this->payWithPix($data);
        $res = $this->payWithPixMp($data);

        if ($res)
            return redirect()->route('checkout-success', ['sale' => $this->sale]);

        return false;
    }
    public function render()
    {
        return view('livewire.checkout');
    }

    protected function createCustomer($user, $data)
    {


        if (!Customer::make()->exists($user->customer)) {
            $customer =  Customer::make()->create($user);
            if ($customer->ok()) {
                $user->update([
                    'customer' => $customer->json('id')
                ]);
            }
        }
        return $customer;
    }

    protected function payWithPixMp($data)
    {

        $res = MercadoPagoConfig::make()->setAccessToken(config('services.mercadopago.token'))
            ->getHttpClient()->withHeader('X-Idempotency-Key', $this->sale->id)
            ->post('/v1/payments', [
                "transaction_amount" => (float) $this->total(),
                "payment_method_id" => data_get($data, 'payment_method_id', 'pix'),
                "payer" => [
                    "email" => data_get($data, 'pix_email')
                ]
            ]);   
        if ($res->ok()) {
            $this->sale->update([
                'data' => [
                    'id' => $res->json('id'),
                    'qr_code' => $res->json('point_of_interaction.transaction_data.qr_code'),
                    'ticket_url' => $res->json('point_of_interaction.transaction_data.ticket_url'),
                    'qr_code_base64' => $res->json('point_of_interaction.transaction_data.qr_code_base64'),
                ],
                'status' => 'pending',
            ]);

            $this->sale->numbers->each(function ($number) {
                $number->update([
                    'status' => 'pending',
                ]);
            });
            Notification::make()
                ->title('Sucesso!')
                ->body(sprintf('Rifa %s comprada com sucesso! a fatura foi enviada para seu email', $this->rifa->name))
                ->success()
                ->send();
            return true;
        } else {
            $this->hasErrors($res->json('error'));
        }
        return false;
    }

    public function payWithPix($data)
    {

        $res = Pix::make()->create($this->sale, [
            "email" => data_get($data, 'pix_email', auth()->user()->email),
            "item_name" => $this->rifa->name,
            "document" => data_get($data, 'document', auth()->user()->document),
        ]);

        if ($res->ok()) {
            $this->sale->update([
                'data' => $res->json(),
                'status' => 'pending',
            ]);

            $this->sale->numbers->each(function ($number) {
                $number->update([
                    'status' => 'pending',
                ]);
            });
            Notification::make()
                ->title('Sucesso!')
                ->body(sprintf('Rifa %s comprada com sucesso!', $this->rifa->name))
                ->success()
                ->send();
            return true;
        } else {
            $this->hasErrors($res->json('error'));
        }
        return false;
    }


    public function total(): float
    {

        return  $this->sale->total;
    }

    public function discount()
    {
        if ($this->sale->cupon) {
            return $this->sale->cupon->value;
        }

        return 0;
    }

    public function subtotal()
    {
        return $this->total() - $this->discount();
    }

    protected function hasErrors($errors)
    {
        if ($errors) {
            if (is_string($errors)) {
                Notification::make()
                    ->title('Erro!')
                    ->body($errors)
                    ->danger()
                    ->send();
            } else {
                foreach ($errors as $key => $error) {
                    foreach ($error as $message) {
                        $this->addError('data.email', $message);
                        Notification::make()
                            ->title('Erro!')
                            ->body($message)
                            ->danger()
                            ->send();
                    }
                }
            }
        }
    }

    public function removeSale()
    {
        $this->sale->numbers->each(function ($number) {
            $number->delete();
        });

        $this->sale->delete();

        return redirect()->route('rifas.show', ['record' => $this->rifa]);
    }
}
