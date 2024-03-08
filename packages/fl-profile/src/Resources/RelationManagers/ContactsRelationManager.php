<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Callcocam\Profile\Resources\RelationManagers;

use Callcocam\Profile\Traits\HasProfileForm;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Leandrocfe\FilamentPtbrFormFields\PhoneNumber;

class ContactsRelationManager extends RelationManager
{
    use HasProfileForm;

    protected static string $relationship = 'contacts';

    protected static ?string $title = 'Contatos';

    protected static ?string $icon =  'fas-address-book';

    public static function getIcon(Model $ownerRecord, string $pageClass): ?string
    {
        return config('profile.resources.contacts.icon', static::$icon);
    }

    public static function getIconPosition(Model $ownerRecord, string $pageClass): IconPosition
    {
        return config('profile.resources.contacts.iconPosition', static::$iconPosition);
    }

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return config('profile.resources.contacts.badge', static::$badge);
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return  config('profile.resources.contacts.title',   parent::getTitle($ownerRecord, $pageClass));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema($this->getFormSchemaContact());
    }

    public function table(Table $table): Table
    {
        return $table
            ->modelLabel(__('profile::profile.forms.contact.modelLabel'))
            ->pluralModelLabel(__('profile::profile.forms.contact.pluralModelLabel'))
            ->recordTitleAttribute(config('profile.resources.contacts.title', 'name'))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('profile::profile.forms.contact.name.label')),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('profile::profile.forms.contact.description.label')),
            ])
            ->filters([
                //
            ])
            ->headerActions(config('profile.resources.contacts.header_actions', [
                Tables\Actions\CreateAction::make(),
            ]))
            ->actions(config('profile.resources.contacts.actions', [
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]))
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make(config(
                    'profile.resources.contacts.bulk_actions',
                    [
                        Tables\Actions\DeleteBulkAction::make(),
                    ]
                )),
            ])
            ->emptyStateActions(config('profile.resources.contacts.emptyState_actions', [
                Tables\Actions\CreateAction::make(),
            ]));
    }
}
