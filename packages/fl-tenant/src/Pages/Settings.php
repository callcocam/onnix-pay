<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Callcocam\Tenant\Pages;

use App\Models\Tenant;
use Callcocam\Profile\Traits\HasProfileForm;
use Callcocam\Tenant\Traits\HasEditorColumn;
use Callcocam\Tenant\Traits\HasTenantSchemaForm; 
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form; 
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Notifications\Notification;
use Filament\Pages\Page; 

class Settings extends Page implements HasForms
{
    use   InteractsWithForms, HasProfileForm , HasTenantSchemaForm, HasEditorColumn;

    protected static ?string $navigationGroup = "Configurações";

    protected static ?string $modelLabel = "Locatário";

    protected static ?string $pluralModelLabel = "Locatários";

    protected static ?string $navigationLabel = "Locatário";

    protected static ?string $navigationIcon = 'fas-building-user';

    protected static string $view = 'tenant::filament.pages.settings';

    public ?array $data = [];

    public function mount()
    {
        $this->form->fill(get_tenant()->toArray());
    }

    public static function getNavigationGroup(): ?string
    {
        return config('tenant.navigation.tenant.group', static::$navigationGroup);
    }

    public static function getNavigationIcon(): ?string
    {
        return config('tenant.navigation.tenant.icon', static::$navigationIcon);
    }

    public static function getNavigationLabel(): string
    {
        return  config('tenant.navigation.tenant.label', static::$navigationLabel) ?? parent::getNavigationLabel();
    }

    public static function getNavigationBadge(): ?string
    {
        return config('tenant.navigation.tenant.badge',  null);
    }

    /**
     * @return string | array{50: string, 100: string, 200: string, 300: string, 400: string, 500: string, 600: string, 700: string, 800: string, 900: string, 950: string} | null
     */
    public static function getNavigationBadgeColor(): string | array | null
    {
        return config('tenant.navigation.tenant.badge_color', null);
    }

    public static function getNavigationSort(): ?int
    {
        return config('tenant.navigation.tenant.sort', static::$navigationSort);
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Informações do Locatário')
                    ->columns(12)
                    ->schema(function () {
                        $contents = $this->getTenantSchemaFrom(); 
         
                        $contents[] = static::getEditorFormField();
        
                        return $contents;
                    })->columns(12),
                Fieldset::make(__('tenant::tenant.forms.address.modelLabel'))
                    ->statePath('address')
                    ->schema($this->getFormSchemaAddress())
                    ->columns(12),
                Fieldset::make(__('tenant::tenant.forms.contact.modelLabel'))
                    ->schema([
                        Repeater::make('contacts')
                            ->addActionLabel(__('tenant::tenant.forms.contact.addActionLabel'))
                            ->hiddenLabel()
                            ->schema($this->getFormSchemaContact())
                            ->columns(2)
                            ->columnSpanFull()
                    ])
                    ->columns(12),
                Fieldset::make(__('tenant::tenant.forms.document.modelLabel'))
                    ->schema([
                        Repeater::make('documents')
                            ->addActionLabel(__('tenant::tenant.forms.document.addActionLabel'))
                            ->hiddenLabel()
                            ->schema($this->getFormSchemaDocument())
                            ->columns(2)
                            ->columnSpanFull()
                    ]),
                Fieldset::make(__('tenant::tenant.forms.social.modelLabel'))
                    ->schema([
                        Repeater::make('socials')
                            ->addActionLabel(__('tenant::tenant.forms.social.addActionLabel'))
                            ->hiddenLabel()
                            ->schema($this->getFormSchemaSocial())
                            ->columns(2)
                            ->columnSpanFull()
                    ])
                    ->columns(12),

            ])->columns(1)
            ->statePath('data');
    }

    public function save()
    {
        $this->validate();

        $data = collect($this->form->getState());

        $address = $data->get('address');
        $contacts = $data->get('contacts');
        $documents = $data->get('documents');
        $socials = $data->get('socials');

        get_tenant()->update($data->except('address', 'contacts', 'documents', 'socials')->toArray());

        if ($address) {
            if ($id = data_get($address, 'id')) {
                get_tenant()->address()->find($id)->update($address);
            } else {
                get_tenant()->address()->create($address);
            }
        }
        if ($contacts) {
            foreach ($contacts as $contact) {
                if ($id = data_get($contact, 'id')) {
                    get_tenant()->contacts()->find($id)->update($contact);
                } else {
                    get_tenant()->contacts()->create($contact);
                }
            }
        }
        if ($documents) {
            foreach ($documents as $document) {
                if ($id = data_get($document, 'id')) {
                    get_tenant()->documents()->find($id)->update($document);
                } else {
                    get_tenant()->documents()->create($document);
                }
            }
        }
        if ($socials) {
            foreach ($socials as $social) {
                if ($id = data_get($social, 'id')) {
                    get_tenant()->socials()->find($id)->update($social);
                } else {
                    get_tenant()->socials()->create($social);
                }
            }
        }
        Notification::make(get_tenant_id())->title('Sucesso!')
            ->body('Locatário atualizado com sucesso!')
            ->success()->send();
    }
}
