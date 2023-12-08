<?php

namespace App\Livewire;

use App\Livewire\Checkouts\AccountWith;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
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

    public function init(): void
    {
        //$this->dispatch('open-modal', ['id' => 'checkout']);
    }

    public function mount(): void
    {
        $user = auth()->user();
        $user->load('address');
        $this->form->fill($user->toArray());
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('account')->schema($this->getAccountSchema()),
                    Step::make('address')
                        ->statePath('address')
                        ->afterValidation(function ($state) {
                            $this->getAccountAddressAfterValidation($state);
                        })
                        ->schema($this->getAccountAddressSchema())->columns(6),
                    Step::make('payment')
                        ->schema([
                            Radio::make('payment_method')
                                ->options([
                                    'credit_card' => 'Cartão de Crédito',
                                    'paypal' => 'PayPal',
                                    'billet' => 'Boleto',
                                    'pix' => 'Pix',
                                    'transfer' => 'Transferência'
                                ])
                                ->reactive()
                                ->inline(true)
                                ->required(),

                            Fieldset::make('credit_card')->schema( $this->getAccountCreditCardSchema())
                                ->label('Credit Card')
                                ->visible(fn ($get): bool => $get('payment_method') === 'credit_card'),

                            Fieldset::make('paypal')->schema($this->getAccountPayPalSchema())
                                ->label('PayPal')
                                ->visible(fn ($get): bool => $get('payment_method') === 'paypal'),
                            Fieldset::make('billet')->schema($this->getAccountBilletSchema())
                                ->label('Boleto')
                                ->visible(fn ($get): bool => $get('payment_method') === 'billet'),
                            Fieldset::make('pix')->schema($this->getAccountPixSchema())
                                ->label('Pix')
                                ->visible(fn ($get): bool => $get('payment_method') === 'pix'),
                            Fieldset::make('transfer')->schema($this->getAccountTransferSchema())
                                ->label('Transferência')
                                ->visible(fn ($get): bool => $get('payment_method') === 'transfer'),
                        ]),
                ])
                    ->submitAction(new HtmlString(view('components.checkout-submit'))),
                //  ->startOnStep(3)
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        sleep(1);
        $data = $this->form->getState();


        dd($data);

        $this->dispatch('close-modal', ['id' => 'checkout']);


        Notification::make()
            ->title('Sucesso!')
            ->body($data['name'] . ', seu pedido foi enviado com sucesso!')
            ->success()
            ->send();
    }
    public function render()
    {
        return view('livewire.checkout');
    }
}
