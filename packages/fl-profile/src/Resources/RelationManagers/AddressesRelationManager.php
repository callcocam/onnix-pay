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
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class AddressesRelationManager extends RelationManager
{
    use HasProfileForm;

    protected static string $relationship = 'addresses';

    protected static ?string $title = 'Endereços';

    protected static ?string $icon =  'fas-map-location-dot';


    public static function getIcon(Model $ownerRecord, string $pageClass): ?string
    {
        return config('profile.resources.address.icon', static::$icon);
    }

    public static function getIconPosition(Model $ownerRecord, string $pageClass): IconPosition
    {
        return config('profile.resources.address.iconPosition', static::$iconPosition);
    }

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return config('profile.resources.address.badge', static::$badge);
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return  config('profile.resources.address.title',   parent::getTitle($ownerRecord, $pageClass));
    }

    public function form(Form $form): Form
    {
        return $form->schema($this->getFormSchemaAddress())->columns(12);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modelLabel(__('profile::profile.forms.address.modelLabel'))
            ->pluralModelLabel(__('profile::profile.forms.address.pluralModelLabel'))
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('profile::profile.forms.address.name.label'))
                    ->placeholder(__('profile::profile.forms.address.name.placeholder'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('zip')
                    ->label(__('profile::profile.forms.address.zip.label'))
                    ->placeholder(__('profile::profile.forms.address.zip.placeholder'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('street')
                    ->label(__('profile::profile.forms.address.street.label'))
                    ->placeholder(__('profile::profile.forms.address.street.placeholder'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions(
                config('profile.resources.address.header_actions', [
                    Tables\Actions\CreateAction::make(),
                ])
            )
            ->actions(
                config('profile.resources.address.actions', [
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            )
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make(config(
                    'profile.resources.address.bulk_actions',
                    [
                        Tables\Actions\DeleteBulkAction::make(),
                    ]
                )),
            ])
            ->emptyStateActions(config(
                'profile.resources.address.emptyState',
                [
                    Tables\Actions\CreateAction::make(),
                ]
            ));
    }
}
