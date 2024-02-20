<?php

namespace App\Livewire\Profile;

use App\Livewire\Checkouts\AccountWith;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Livewire\Component;

class ShowComponent extends FormsComponent
{
    use AccountWith;

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
                    ->schema($this->getAccountSchema()),
                Section::make('Address Information')
                    ->columns(12)
                    ->statePath('address')
                    ->schema($this->getAccountAddressSchema()),
            ])
            ->statePath('data');
    }

    public function render()
    {
        return view('livewire.profile.show-component');
    }
}
