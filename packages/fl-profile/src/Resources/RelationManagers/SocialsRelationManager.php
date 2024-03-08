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

class SocialsRelationManager extends RelationManager
{
    use HasProfileForm;

    protected static string $relationship = 'socials';

    protected static ?string $title = 'Redes Sociais';

    protected static ?string $icon =  'fas-share-alt';


    public static function getIcon(Model $ownerRecord, string $pageClass): ?string
    {
        return config('profile.resources.social.icon', static::$icon);
    }

    public static function getIconPosition(Model $ownerRecord, string $pageClass): IconPosition
    {
        return config('profile.resources.social.iconPosition', static::$iconPosition);
    }

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return config('profile.resources.social.badge', static::$badge);
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return  config('profile.resources.social.title',   parent::getTitle($ownerRecord, $pageClass));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema($this->getFormSchemaSocial());
    }

    public function table(Table $table): Table
    {
        return $table
            ->modelLabel(__('profile::profile.forms.social.modelLabel'))
            ->pluralModelLabel(__('profile::profile.forms.social.pluralModelLabel'))
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('profile::profile.forms.social.name.label'))
                    ->searchable(),
            ])
            ->filters(config('profile.resources.social.filters', [
                //
            ]))
            ->headerActions(
                config('profile.resources.social.header_actions', [
                    Tables\Actions\CreateAction::make(),
                ])
            )
            ->actions(
                config('profile.resources.social.actions', [
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            )
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make(config('profile.resources.social.bulk_actions', [
                    Tables\Actions\DeleteBulkAction::make(),
                ])),
            ])
            ->emptyStateActions(config('profile.resources.social.emptyState', [
                Tables\Actions\CreateAction::make(),
            ]));
    }
}
