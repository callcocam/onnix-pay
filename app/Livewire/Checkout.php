<?php

namespace App\Livewire;

use App\Livewire\Checkouts\AccountWith;
use App\Services\Onixpay\Address;
use App\Services\Onixpay\AuthService;
use App\Services\Onixpay\Bill;
use App\Services\Onixpay\Customer;
use App\Services\Onixpay\Pix;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Notifications\Notification;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\HtmlString;

class Checkout extends FormsComponent
{
    use AccountWith;

    public ?array $data = [];

    public $sales;

    protected $authService;

    public function init(): void
    {
        //$this->dispatch('open-modal', ['id' => 'checkout']);

    }

    public function mount(): void
    {
        if (!auth()->check()) {
            return;
        }

        $user = auth()->user();
        $user->load('address');
        $this->form->fill($user->toArray());
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('account')
                        ->label('Minha Conta')
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
                            Radio::make('payment_method')
                                ->label('Meio de Pagamento')
                                ->options([
                                    'credit_card' => 'Cartão de Crédito',
                                    'billet' => 'Boleto',
                                    'pix' => 'Pix',
                                ])
                                ->reactive()
                                ->inline(true)
                                ->required(),

                            Fieldset::make('credit_card')->schema($this->getAccountCreditCardSchema())
                                ->label('Cartão de Crédito')
                                ->visible(fn ($get): bool => $get('payment_method') === 'credit_card'),
                            Fieldset::make('billet')->schema($this->getAccountBilletSchema())
                                ->label('Boleto')
                                ->visible(fn ($get): bool => $get('payment_method') === 'billet'),
                            Fieldset::make('pix')->schema($this->getAccountPixSchema())
                                ->label('Pix')
                                ->visible(fn ($get): bool => $get('payment_method') === 'pix'),
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


        if (!$user->document) {
            $user->update([
                'document' => $data['document']
            ]);
        }

        if (!$user->phone) {
            $user->update([
                'phone' => $data['phone']
            ]);
        }

        if (!$user->customer) {

            if (!Customer::make()->exists($user->customer)) {
                $custemer =  Customer::make()->create([
                    "name" => $user->name,
                    "email" => $user->email,
                    "document" => $user->document,
                    "document_type" => strlen($user->document) >= 14 ? "CNPJ" : "CPF",
                    "phone" => $user->phone,
                    "mobilephone" => $user->phone,
                    "country_id" => 30,
                    "zipcode" => $user->address->zip,
                    "state" => $user->address->state,
                    "city" => $user->address->city,
                    "district" => $user->address->district,
                    "street" => $user->address->street,
                    "number" => $user->address->number,
                ]);
                if ($custemer->ok()) {
                    $user->update([
                        'customer' => $custemer->json('id')
                    ]);
                }
            }
        }

        $paymentMethod = $data['payment_method'];

        $this->cartItems();


        $order = $user->orderDratf()->first();
        if (!$order) {
            $order = $user->orders()->create([
                'invoice' => uniqid(),
                "total" => $this->total(),
                "discount" => $this->discount(),
                "shipping" => 0,
                "subtotal" => $this->subtotal(),
                "status" => "draft",
                "payment_method" => $paymentMethod,
                "quantity" => 1,
                "description" => "Pedido de compra",
            ]);
        }

        $res = false;
        switch ($paymentMethod) {
            case 'credit_card':
                $res =  $this->payWithCreditCard($data, $order);
                break;
            case 'billet':
                $res =  $this->payWithBillet($data,  $order);
                break;
            case 'pix':
                $res = $this->payWithPix($data,  $order);
                break;
        }

        if ($res)
            return redirect()->route('checkout-success', ['order' => $order->id]);

        return false;
    }
    public function render()
    {
        return view('livewire.checkout');
    }

    public function payWithCreditCard($data, $order)
    {
        // ...
    }

    public function payWithBillet($data, $order)
    {
        $rifas = [];

        $this->sales->each(function ($sale) use ($order, &$rifas) {
            if ($sale->order_id === null) {
                $sale->update([
                    'order_id' => $order->id,
                ]);
            }
            if ($sale->rifa) {
                $rifas[] = $sale->rifa->name;
            }
        });

        $res =  Bill::make()->create([
            "amount" =>  $order->total,
            "quantity" => $order->quantity,
            "discount" => $order->discount,
            "invoice_no" => $order->invoice,
            "due_date" => $order->created_at->addDays(3)->format('Y-m-d'),  
            "item_name" => get_tenant()->name . " - " . $order->id,
            "notes" => str($order->description)->append(" - Rifas: " . implode(", ", $rifas))->toString(),
            "customer" => auth()->user()->customer,
            "instructions" => "Não receber após o vencimento",
        ]);

        if ($res->ok()) {
            $order->update([
                'data' => $res->json(),
                'status' => 'pending',
                'description' => str($order->description)->append(" - Rifas: " . implode(", ", $rifas))->toString()
            ]);

            Notification::make()
                ->title('Sucesso!')
                ->body($data['name'] . ', seu pedido foi enviado com sucesso!')
                ->success()
                ->send();
            return true;
        } else {
            $errors = $res->json('error');
            dd($res);
            if ($errors) {
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
        return false;
    }

    public function payWithPix($data, $order)
    {

        $rifas = [];
        $this->sales->each(function ($sale) use ($order, &$rifas) {
            if ($sale->order_id === null) {
                $sale->update([
                    'order_id' => $order->id,
                ]);
            }
            if ($sale->rifa) {
                $rifas[] = $sale->rifa->name;
            }
        });


        $res = Pix::make()->create([
            "amount" =>  $order->total,
            "email" => data_get($data, 'pix_email', auth()->user()->email),
            "quantity" => $order->quantity,
            "discount" => $order->discount,
            "invoice_no" => $order->invoice,
            "due_date" => $order->created_at->addDays(3)->format('Y-m-d'),
            "tax" => $order->shipping,
            "item_name" => get_tenant()->name . " - " . $order->id,
            "notes" => str($order->description)->append(" - Rifas: " . implode(", ", $rifas))->toString(),
            "document" => data_get($data, 'document', auth()->user()->document),
            "client" => auth()->user()->name
        ]);

        $order->update([
            'status' => 'pending',
            'data' => $res->json(),
            'description' => str($order->description)->append(" - Rifas: " . implode(", ", $rifas))->toString()
        ]);
    }

    public function cartItems()
    {
        if (!auth()->check()) {
            return;
        }
        $this->sales = auth()->user()->sales()->whereIn('status', ['pending', 'draft'])->get();
        return   $this;
    }

    public function total(): float
    {

        return  $this->sales->map(function ($sale) {
            if ($sale->rifa) {
                return $sale->rifa->price * $sale->numbers->count();
            }
            return 0;
        })->sum();
    }

    public function discount()
    {
        return $this->sales->map(function ($sale) {
            if ($sale->cupon) {
                return $sale->cupon->value;
            }
            return 0;
        })->sum();
    }

    public function subtotal()
    {
        return $this->total() - $this->discount();
    }
}
