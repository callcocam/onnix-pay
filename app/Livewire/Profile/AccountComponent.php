<?php

namespace App\Livewire\Profile;

use App\Livewire\Checkouts\AccountWith;
use Callcocam\Acl\Traits\HasPasswordCreateOrUpdate;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Notifications\Notification;
use Leandrocfe\FilamentPtbrFormFields\Document;
use Leandrocfe\FilamentPtbrFormFields\PhoneNumber;

class AccountComponent extends FormsComponent
{
    use AccountWith, HasPasswordCreateOrUpdate;

    public ?array $data = [];

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
                Section::make('Account Information')
                    ->columns(12)
                    ->schema(
                        [
                            FileUpload::make('cover')
                                ->image()
                                ->openable()
                                ->columnSpanFull(),
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
                        ]
                    ),
                Section::make('Alterar Senha')
                    ->columns(3)
                    ->schema(static::getFieldPasswordForUpdateForm()),
                Section::make('Address Information')
                    ->columns(12)
                    ->statePath('address')
                    ->schema($this->getAccountAddressSchema()),
            ])
            ->statePath('data');
    }

    public function updateUserProfile(): void
    {
        $this->validate();
        $user = auth()->user();
        $user->update(collect($this->data)->only('name', 'email', 'document', 'phone')->toArray());
        $this->updatePassword($user);
        $this->updateAddress($user);
        $this->updateProfilePhoto($user);
        $this->dispatch('notify-saved');

        Notification::make($user->id)
            ->title('Informações atualizadas com sucesso!')
            ->body('Suas informações foram atualizadas com sucesso!')
            ->send();
    }

    protected function updateAddress($user)
    {
        $user->address()->updateOrCreate(
            ['id' => $user->address->id],
            $this->data['address']
        );
    }


    protected function updatePassword($user)
    {
        if (isset($this->data['password'])) {
            $user->update(['password' => bcrypt($this->data['password'])]);
        }
    }

    protected function updateProfilePhoto($user)
    {
        if (!empty($this->data['cover'])) {
            foreach ($this->data['cover'] as $cover) { 
                $user->updateProfilePhoto($cover);
            }
        }
    }



    public function render()
    {
        return view('livewire.profile.account-component');
    }
}
