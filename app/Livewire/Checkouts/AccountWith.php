<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Livewire\Checkouts;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Select;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;
use Leandrocfe\FilamentPtbrFormFields\Document;
use Leandrocfe\FilamentPtbrFormFields\PhoneNumber;

trait AccountWith
{

    public function getAccountSchema()
    {
        return [
            TextInput::make('name')
                ->columnSpan([
                    'sm' => 6,
                    'md' => 4,

                ])
                ->required(),
            TextInput::make('email')
                ->email()
                ->columnSpan([
                    'sm' => 6,
                    'md' => 4,

                ])
                ->required(),
            Document::make('document')
                ->dynamic()
                ->columnSpan([
                    'sm' => 6,
                    'md' => 2,

                ])
                ->required(),
            PhoneNumber::make('phone')
                ->columnSpan([
                    'sm' => 6,
                    'md' => 2,

                ])
                ->required(),
        ];
    }

    public function getAccountAddressSchema()
    {
        return [
            TextInput::make('zip')
                ->label('CEP')
                ->extraAlpineAttributes(['x-mask' => '99999-999'])
                ->required()
                ->columnSpan(2)
                ->suffixAction(function ($state, $livewire, $component, $set) {
                    return Action::make('search')
                        ->icon('heroicon-o-plus')
                        ->action(function () use ($state, $livewire, $component, $set) {

                            $fieldName = $component->getStatePath();
                            $validate = $livewire->validateOnly($fieldName);

                            $request = Http::get("viacep.com.br/ws/$state/json/")->json();

                            throw_if(
                                Arr::has($request, 'erro'),
                                ValidationException::withMessages([$fieldName => 'CEP não encontrado.'])
                            );

                            $set('street', data_get($request, 'logradouro'));
                            $set('complement', data_get($request, 'complemento'));
                            $set('district', data_get($request, 'bairro'));
                            $set('city', data_get($request, 'localidade'));
                            $set('state', data_get($request, 'uf'));
                        });
                }),
            TextInput::make('street')
                ->label('Rua')
                ->required()
                ->columnSpan(4),
            TextInput::make('number')
                ->label('Número')
                ->required()
                ->columnSpan(2),
            TextInput::make('complement')
                ->label('Complemento')
                ->columnSpan(4),
            TextInput::make('district')
                ->label('Bairro')
                ->required()
                ->columnSpan(3),
            TextInput::make('city')
                ->label('Cidade')
                ->required()
                ->columnSpan(3),
            Select::make('state')
                ->label('Estado')
                ->searchable()
                ->options(File::json(public_path('data/states.json')))
                ->required()
                ->columnSpanFull(),
        ];
    }

    public function getAccountAddressAfterValidation($state)
    {
        $user = auth()->user();
        $user->load('address');
        if (!$user->address) {
            $state['created_at'] = now();
            $state['updated_at'] = now();
            $user->address()->create($state);
        } else {
            $state['created_at'] = $user->address->created_at->format('Y-m-d H:i:s');
            $state['updated_at'] = now();
            $user->address()->update($state);
        }
    }

    public function getAccountCreditCardSchema()
    {
        return [
            TextInput::make('card_number')
                ->required()
                ->extraAlpineAttributes(['x-mask' => '9999-9999-9999-9999']),
            TextInput::make('name_on_card')
                ->required(),
            TextInput::make('expiration_date')
                ->required()
                ->extraAlpineAttributes(['x-mask' => '99/99']),
            TextInput::make('cvv')
                ->required()
                ->extraAlpineAttributes(['x-mask' => '999']),
        ];
    }


    public function getAccountBilletSchema()
    {
        return [
            TextInput::make('billet_email')
                ->email() 
                ->required()
                ->columnSpanFull(),
        ];
    }

    public function getAccountPixSchema()
    {
        return [
            TextInput::make('pix_email')
                ->email() 
                ->required()
                ->columnSpanFull(),
        ];
    }

    public function getAccountTransferSchema()
    {
        return [
            TextInput::make('transfer_email')
                ->email()
                ->required()
                ->columnSpanFull(),
        ];
    }
}
