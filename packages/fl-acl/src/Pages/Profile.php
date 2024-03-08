<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Callcocam\Acl\Pages;

use App\Models\User;
use Callcocam\Acl\Traits\HasUserFormSchema;
use Callcocam\Profile\Traits\HasProfileForm;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class Profile extends Page implements HasForms
{
    use   InteractsWithForms, HasProfileForm, HasUserFormSchema;

    protected static ?string $navigationGroup = "Configurações";

    protected static ?string $modelLabel = "Perfil";

    protected static ?string $pluralModelLabel = "Perfis";

    protected static ?string $navigationLabel = "Perfil";

    protected static ?string $navigationIcon = 'fas-user';

    protected static string $view = 'acl::filament.pages.profile';

    public ?array $data = [];

    public function mount()
    {
        $this->form->fill(User::find(auth()->id())->toArray());
    }

    public static function getNavigationGroup(): ?string
    {
        return config('acl.navigation.profile.group', static::$navigationGroup);
    }

    public static function getNavigationIcon(): ?string
    {
        return config('acl.navigation.profile.icon', static::$navigationIcon);
    }


    public static function getNavigationLabel(): string
    {
        return  config('acl.navigation.profile.label', static::$navigationLabel) ?? parent::getNavigationLabel();
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Fieldset::make('Informações do usuário')
                    ->columns(12)
                    ->schema(function () {
                        $contents = $this->userFormSchema(excludes: ['roles', 'type', 'status']);

                        return $contents;
                    })->columns(12),
                Fieldset::make(__('acl::acl.forms.address.modelLabel'))
                    ->statePath('addresses')
                    ->schema(
                        [
                            Repeater::make('addresses')
                            ->addActionLabel(__('acl::acl.forms.address.addActionLabel'))
                                ->hiddenLabel()
                                ->schema($this->getFormSchemaAddress())
                                ->columns(12)
                                ->maxItems(1)
                                ->columnSpanFull()
                        ]
                    )
                    ->columns(12),
                Fieldset::make(__('acl::acl.forms.contact.modelLabel'))
                    ->schema([
                        Repeater::make('contacts')
                            ->addActionLabel(__('acl::acl.forms.contact.addActionLabel'))
                            ->hiddenLabel()
                            ->schema($this->getFormSchemaContact())
                            ->columns(2)
                            ->columnSpanFull()
                    ])
                    ->columns(1),
                Fieldset::make(__('acl::acl.forms.document.modelLabel'))
                    ->schema([
                        Repeater::make('documents')
                            ->addActionLabel(__('acl::acl.forms.document.addActionLabel'))
                            ->hiddenLabel()
                            ->schema($this->getFormSchemaDocument())
                            ->columns(2)
                            ->columnSpanFull()
                    ]),
                Fieldset::make(__('acl::acl.forms.social.modelLabel'))
                    ->schema([
                        Repeater::make('socials')
                            ->addActionLabel(__('acl::acl.forms.social.addActionLabel'))
                            ->hiddenLabel()
                            ->schema($this->getFormSchemaSocial())
                            ->columns(2)
                            ->columnSpanFull()
                    ])
                    ->columns(1),

            ])->columns(1);
    }

    public static function getNavigationBadge(): ?string
    {
        return config('acl.navigation.profile.badge',  null);
    }

    public function save()
    {
        $this->validate();

        $data = collect($this->form->getState());

        $addresses = $data->get('addresses');
        $contacts = $data->get('contacts');
        $documents = $data->get('documents');
        $socials = $data->get('socials');

        $user = User::find(auth()->id());

        $user->update($data->except('address', 'contacts', 'documents', 'socials')->toArray());

        if ($addresses) {
            foreach ($addresses as $address) {
                if ($id = data_get($address, 'id')) {
                    $user->addresses()->find($id)->update($address);
                } else {
                    $user->addresses()->create($address);
                }
            }
        }
        if ($contacts) {
            foreach ($contacts as $contact) {
                if ($id = data_get($contact, 'id')) {
                    $user->contacts()->find($id)->update($contact);
                } else {
                    $user->contacts()->create($contact);
                }
            }
        }
        if ($documents) {
            foreach ($documents as $document) {
                if ($id = data_get($document, 'id')) {
                    $user->documents()->find($id)->update($document);
                } else {
                    $user->documents()->create($document);
                }
            }
        }
        if ($socials) {
            foreach ($socials as $social) {
                if ($id = data_get($social, 'id')) {
                    $user->socials()->find($id)->update($social);
                } else {
                    $user->socials()->create($social);
                }
            }
        }
        Notification::make(get_tenant_id())->title('Sucesso!')
            ->body('Usuário atualizado com sucesso!')
            ->success()->send();
    }
}
