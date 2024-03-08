<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Callcocam\Profile\Traits;

use Filament\Forms;
use Filament\Forms\Get;
use Leandrocfe\FilamentPtbrFormFields\Document;
use Leandrocfe\FilamentPtbrFormFields\PhoneNumber;

trait HasProfileForm
{

    public function getFormSchemaAddress()
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label(__('profile::profile.forms.address.name.label'))
                ->placeholder(__('profile::profile.forms.address.name.placeholder'))
                ->columnSpan([
                    'md' => config('profile.resources.address.name.columnSpan', 5),
                ])
                ->hidden(config('profile.resources.address.name.hidden', false))
                ->required(config('profile.resources.address.name.required', true))
                ->maxLength(config('profile.resources.address.name.maxLength', 255)),
            \Leandrocfe\FilamentPtbrFormFields\Cep::make('zip')
                ->label(__('profile::profile.forms.address.zip.label'))
                ->placeholder(__('profile::profile.forms.address.zip.placeholder'))
                ->hidden(config('profile.resources.address.zip.hidden', false))
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
                ->columnSpan([
                    'md' => config('profile.resources.address.zip.columnSpan', 3),
                ])
                ->required(config('profile.resources.address.zip.required', true))
                ->maxLength(config('profile.resources.address.zip.maxLength', 255)),
            Forms\Components\TextInput::make('street')
                ->label(__('profile::profile.forms.address.street.label'))
                ->placeholder(__('profile::profile.forms.address.street.placeholder'))
                ->hidden(config('profile.resources.address.street.hidden', false))
                ->columnSpan([
                    'md' => config('profile.resources.address.street.columnSpan', 4),
                ])
                ->required(config('profile.resources.address.street.required', true))
                ->maxLength(config('profile.resources.address.street.maxLength', 255)),
            Forms\Components\TextInput::make('number')
                ->label(__('profile::profile.forms.address.number.label'))
                ->placeholder(__('profile::profile.forms.address.number.placeholder'))
                ->columnSpan([
                    'md' => config('profile.resources.address.number.columnSpan', 4),
                ])
                ->required(config('profile.resources.address.number.required', true))
                ->maxLength(config('profile.resources.address.number.maxLength', 255)),
            Forms\Components\TextInput::make('complement')
                ->label(__('profile::profile.forms.address.complement.label'))
                ->placeholder(__('profile::profile.forms.address.complement.placeholder'))
                ->columnSpan([
                    'md' => config('profile.resources.address.complement.columnSpan', 8),
                ])
                ->required(config('profile.resources.address.complement.required', false))
                ->maxLength(config('profile.resources.address.complement.maxLength', 255)),
            Forms\Components\TextInput::make('district')
                ->label(__('profile::profile.forms.address.district.label'))
                ->placeholder(__('profile::profile.forms.address.district.placeholder'))
                ->columnSpan([
                    'md' => config('profile.resources.address.district.columnSpan', 4),
                ])
                ->required(config('profile.resources.address.district.required', true))
                ->maxLength(config('profile.resources.address.district.maxLength', 255)),
            Forms\Components\TextInput::make('city')
                ->label(__('profile::profile.forms.address.city.label'))
                ->placeholder(__('profile::profile.forms.address.city.placeholder'))
                ->columnSpan([
                    'md' => config('profile.resources.address.city.columnSpan', 5),
                ])
                ->required(config('profile.resources.address.city.required', true))
                ->maxLength(config('profile.resources.address.city.maxLength', 255)),
            Forms\Components\Select::make('state')
                ->options(config('profile.resources.address.options.state', []))
                ->label(__('profile::profile.forms.address.state.label'))
                ->placeholder(__('profile::profile.forms.address.state.placeholder'))
                ->columnSpan([
                    'md' => config('profile.resources.address.state.columnSpan', 3)
                ])
                ->required(),
            Forms\Components\TextInput::make('country')
                ->label(__('profile::profile.forms.address.country.label'))
                ->placeholder(__('profile::profile.forms.address.country.placeholder'))
                ->default('Brasil')
                ->columnSpan([
                    'md' => config('profile.resources.address.country.columnSpan', 4),
                ])
                ->required(config('profile.resources.address.country.required', false))
                ->maxLength(config('profile.resources.address.country.maxLength', 255)),
            Forms\Components\TextInput::make('latitude')
                ->label(__('profile::profile.forms.address.latitude.label'))
                ->placeholder(__('profile::profile.forms.address.latitude.placeholder'))
                ->columnSpan([
                    'md' => config('profile.resources.address.latitude.columnSpan', 4)
                ])
                ->required(config('profile.resources.address.latitude.required', false))
                ->maxLength(config('profile.resources.address.latitude.maxLength', 255)),
            Forms\Components\TextInput::make('longitude')
                ->label(__('profile::profile.forms.address.longitude.label'))
                ->placeholder(__('profile::profile.forms.address.longitude.placeholder'))
                ->columnSpan([
                    'md' => config('profile.resources.address.longitude.columnSpan', 4)
                ])
                ->required(config('profile.resources.address.longitude.required', false))
                ->maxLength(config('profile.resources.address.longitude.maxLength', 255)),
            Forms\Components\Radio::make('status')
                ->label(__('profile::profile.forms.address.status.label'))
                ->inline()
                ->options([
                    'draft' => 'Rascunho',
                    'published' => 'Publicado',
                ])
                ->columnSpanFull()
                ->required(config('profile.resources.address.status.required', false)),
        ];
    }

    public function getFormSchemaDocument()
    {
        return [
            Forms\Components\Select::make('name')
                ->options(config('profile.resources.documents.options', []))->reactive()
                ->label(__('profile::profile.forms.document.name.label'))
                ->placeholder(__('profile::profile.forms.document.name.placeholder'))
                ->hidden(config('profile.resources.documents.hidden', false))
                ->required(config('profile.resources.documents.required', true)),
            Document::make('description')
                ->mask(function (Get $get) {
                    $type = strtolower($get('name'));
                    switch ($type):
                        case 'cpf':
                            return '999.999.999-99';
                            break;
                        case 'cnpj':
                            return '99.999.999/9999-99';
                            break;
                        case 'rg':
                            return '99.999.999-9';
                            break;
                        default:
                            return null;
                            break;
                    endswitch;
                })
                ->label(__('profile::profile.forms.document.description.label'))
                ->placeholder(__('profile::profile.forms.document.description.placeholder'))
                ->required(config('profile.resources.documents.required', true))
                ->hidden(config('profile.resources.documents.hidden', false))
                ->maxLength(config('profile.resources.documents.maxlength', 255)),
        ];
    }


    public function getFormSchemaContact()
    {
        return [

            Forms\Components\Select::make('name')
                ->options(config('profile.resources.contacts.options', []))
                ->required(config('profile.resources.contacts.required', true))
                ->label(__('profile::profile.forms.contact.name.label'))
                ->placeholder(__('profile::profile.forms.contact.name.placeholder'))
                ->hidden(config('profile.resources.contacts.hidden', false))
                ->reactive(),
            PhoneNumber::make('description')
                ->label(__('profile::profile.forms.contact.description.label'))
                ->placeholder(__('profile::profile.forms.contact.description.placeholder'))
                ->required(config('profile.resources.contacts.required', true))
                ->hidden(config('profile.resources.contacts.hidden', false))
                ->format(function (Get $get) {
                    $type = $get('name');
                    switch ($type):
                        case 'phone':
                        case 'fax':
                            return '(99) 9999-9999';
                            break;
                        case 'cell':
                        case 'whatsapp':
                            return '(99) 99999-9999';
                            break;
                        default:
                            return null;
                            break;
                    endswitch;
                })

        ];
    }

    public function getFormSchemaSocial()
    {
        return [

            Forms\Components\Select::make('name')
                ->options(config('profile.resources.social.options', []))
                ->required(config('profile.resources.social.required', true))
                ->reactive()
                ->label(__('profile::profile.forms.social.name.label'))
                ->hidden(config('profile.resources.social.hidden', false))
                ->placeholder(__('profile::profile.forms.social.name.placeholder')),
            Forms\Components\TextInput::make('description')
                ->suffixIcon(function (Get $get) {
                    $type = $get('name');
                    switch ($type):
                        case 'facebook':
                            return 'fab-facebook';
                            break;
                        case 'twitter':
                            return 'fab-twitter';
                            break;
                        case 'instagram':
                            return 'fab-instagram';
                            break;
                        case 'linkedin':
                            return 'fab-linkedin';
                            break;
                        case 'youtube':
                            return 'fab-youtube';
                            break;
                        case 'tiktok':
                            return 'fab-tiktok';
                            break;
                        case 'telegram':
                            return 'fab-telegram';
                            break;
                        case 'pinterest':
                            return 'fab-pinterest';
                            break;
                        case 'flickr':
                            return 'fab-flickr';
                            break;
                        case 'snapchat':
                            return 'fab-snapchat';
                            break;
                        case 'reddit':
                            return 'fab-reddit';
                            break;
                        case 'discord':
                            return 'fab-discord';
                            break;
                        case 'spotify':
                            return 'fab-spotify';
                            break;
                        case 'github':
                            return 'fab-github';
                            break;
                        case 'blogger':
                            return 'fab-blogger';
                            break;
                        case 'trello':
                            return 'fab-trello';
                            break;
                        case 'slack':
                            return 'fab-slack';
                            break;
                        default:
                            return null;
                            break;
                    endswitch;
                })
                ->label(__('profile::profile.forms.social.description.label'))
                ->placeholder(__('profile::profile.forms.social.description.placeholder'))
                ->hidden(config('profile.resources.social.hidden', false))
                ->required(config('profile.resources.social.required', true)),

        ];
    }
}
