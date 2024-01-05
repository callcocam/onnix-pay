<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Filament\Resources\Rifas;

use App\Filament\Resources\Rifas\RifaResource\Pages;
use App\Filament\Resources\Rifas\RifaResource\RelationManagers;
use App\Models\Rifas\Rifa;
use Callcocam\Tenant\Traits\HasUploadFormField;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Leandrocfe\FilamentPtbrFormFields\Money;

class RifaResource extends Resource
{
    use HasUploadFormField;

    protected static ?string $model = Rifa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

   

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categoria')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome da rifa')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Valor da rifa')
                    ->money('BRL')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Data inicial da competição')
                    ->date()
                    ->searchable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Data final da competição')
                    ->date()
                    ->searchable(),
                Tables\Columns\TextColumn::make('draw_date')
                    ->label('Data do sorteio')
                    ->date()
                    ->searchable(),
                Tables\Columns\TextColumn::make('draw_time')
                    ->label('Hora do sorteio')
                    ->date()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRifas::route('/'),
            'create' => Pages\CreateRifa::route('/create'),
            'edit' => Pages\EditRifa::route('/{record}/edit'),
        ];
    }
}
