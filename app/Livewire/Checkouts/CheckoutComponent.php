<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Livewire\Checkouts;

use App\Models\Rifas\Sales\Sale;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Notifications\Notification;
use Leandrocfe\FilamentPtbrFormFields\Cep;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Computed;

class CheckoutComponent extends FormsComponent
{
    public ?array $data = [];

    public $sales;

    public function init(): void
    {
        //$this->dispatch('open-modal', ['id' => 'checkout']);
    }

    public function mount(): void
    {
        $user = auth()->user();
        $user->load('address');
        $this->form->fill($user->toArray());
        $this->sales = Sale::query()->where('user_id', auth()->id())->where('status', 'pending')->get();
    }

    #[Computed]
    public function cartItems()
    {

        return  $this->sales;
    }

    #[Computed]
    public function total(): float
    {

        return  $this->sales->map(function ($sale) {
            return $sale->rifa->price * $sale->numbers->count();
        })->sum();;
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make([
                    'default' => 1,
                    'md' => 3,
                ])
                    ->schema([
                        Section::make('Dados Pessoais')
                            ->schema([
                                Wizard::make([
                                    Step::make('account')->schema([
                                        TextInput::make('email')
                                            ->email()
                                            ->required(),
                                        TextInput::make('name')
                                            ->required(),
                                    ]),
                                    Step::make('address')
                                        ->statePath('address')
                                        ->afterValidation(function ($state) {
                                        })
                                        ->schema([
                                            Cep::make('zip')
                                                ->viaCep(
                                                    mode: 'suffix', // Determines whether the action should be appended to (suffix) or prepended to (prefix) the cep field, or not included at all (none).
                                                    errorMessage: 'CEP inválido.', // Error message to display if the CEP is invalid.

                                                    /**
                                                     * Other form fields that can be filled by ViaCep.
                                                     * The key is the name of the Filament input, and the value is the ViaCep attribute that corresponds to it.
                                                     * More information: https://viacep.com.br/
                                                     */
                                                    setFields: [
                                                        'street' => 'logradouro',
                                                        'number' => 'numero',
                                                        'complement' => 'complemento',
                                                        'district' => 'bairro',
                                                        'city' => 'localidade',
                                                        'state' => 'uf'
                                                    ]
                                                )
                                                ->label('CEP')
                                                ->columnSpan([
                                                    'md' => 3,
                                                ])
                                                ->required(),
                                            TextInput::make('street')
                                                ->label('Rua / Avenida / Logradouro')
                                                ->columnSpan([
                                                    'md' => 7,
                                                ])
                                                ->required(),
                                            TextInput::make('number')
                                                ->label('Número')
                                                ->columnSpan([
                                                    'md' => 2,
                                                ])
                                                ->required(),
                                            TextInput::make('district')
                                                ->label('Bairro')
                                                ->columnSpan([
                                                    'md' => 4,
                                                ])
                                                ->required(),
                                            TextInput::make('city')
                                                ->label('Cidade')
                                                ->columnSpan([
                                                    'md' => 5,
                                                ])
                                                ->required(),
                                            Select::make('state')
                                                ->label('Estado')
                                                ->columnSpan([
                                                    'md' => 3,
                                                ])
                                                ->searchable()
                                                ->options(File::json(public_path('data/states.json'))),
                                            TextInput::make('complement')
                                                ->label('Complemento (Opcional)')
                                                ->columnSpanFull(),
                                        ])->columns(12),
                                    Step::make('payment')
                                        ->schema([
                                            Radio::make('payment_method')
                                                ->options([
                                                    'credit_card' => 'Cartão de Crédito',
                                                    'billet' => 'Boleto',
                                                    'pix' => 'Pix',
                                                    'transfer' => 'Transferência'
                                                ])
                                                ->reactive()
                                                ->inline(true)
                                                ->required(),

                                            Fieldset::make('credit_card')->schema([
                                                TextInput::make('card_number')
                                                    ->label('Número do Cartão')
                                                    ->columnSpan([
                                                        'md' => 7
                                                    ])
                                                    ->required()
                                                    ->extraAttributes(['id' => 'card-element'])
                                                    ->extraAlpineAttributes(['x-mask' => '9999-9999-9999-9999']),
                                                TextInput::make('name_on_card')
                                                    ->label('Nome no Cartão')
                                                    ->columnSpan([
                                                        'md' => 5
                                                    ])
                                                    ->required(),
                                                TextInput::make('expiration_date')
                                                    ->label('Validade do Cartão')
                                                    ->columnSpan([
                                                        'md' => 3
                                                    ])
                                                    ->required()
                                                    ->extraAlpineAttributes(['x-mask' => '99/99']),
                                                TextInput::make('cvv')
                                                    ->label('CVV')
                                                    ->columnSpan([
                                                        'md' => 3
                                                    ])
                                                    ->required()
                                                    ->extraAlpineAttributes(['x-mask' => '999']),
                                            ])
                                                ->label('Cartão de Crédito')
                                                ->columns(12)
                                                ->visible(fn ($get): bool => $get('payment_method') === 'credit_card'),


                                            Fieldset::make('billet')->schema([])
                                                ->label('Billet')
                                                ->columns(6)
                                                ->visible(fn ($get): bool => $get('payment_method') === 'billet'),

                                            Fieldset::make('pix')->schema([])
                                                ->label('Pix')
                                                ->columns(6)
                                                ->visible(fn ($get): bool => $get('payment_method') === 'pix'),

                                            Fieldset::make('transfer')->schema([])
                                                ->label('Transferência')
                                                ->columns(6)
                                                ->visible(fn ($get): bool => $get('payment_method') === 'transfer'),
                                        ]),
                                ])
                            ])->columnSpan([
                                'md' => 2,
                            ]),
                        Section::make('Endereço de Entrega')
                            ->schema([])
                            ->columnSpan([
                                'md' => 1,
                            ]),
                    ])
            ])
            ->statePath('data');
    }

    public function render()
    {
        return view('livewire.checkouts.checkout-component');
    }
}
