<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContestResource\Pages;
use App\Filament\Resources\ContestResource\RelationManagers;
use App\Filament\Resources\ContestResource\Widgets\ContestOverview;
use App\Models\Contest;
use Callcocam\Acl\Traits\HasDatesFormForTableColums;
use Callcocam\Acl\Traits\HasStatusColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContestResource extends Resource
{
    use HasStatusColumn, HasDatesFormForTableColums;

    protected static ?string $model = Contest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Concurso';

    protected static ?string $pluralModelLabel = 'Concursos';

   
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome ou Número do Concuso')
                    ->searchable(),
                Tables\Columns\TextColumn::make('number')
                    ->label('Número do Concuso')
                    ->searchable(),
                Tables\Columns\TextColumn::make('drawn_at')
                    ->label('Data do Sorteio')
                    ->dateTime()
                    ->sortable(),
                static::getStatusTableIconColumn(),
                ...static::getFieldDatesFormForTable()
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

    
    public static function getStatusTableIconColumn(): IconColumn
    {
        return  IconColumn::make('status')
            ->label(static::getStatusColumnLabel())
            ->color(fn (string $state): string => match ($state) {
                'draft' => 'danger',
                'reviewing' => 'warning',
                'published' => 'success',
                'concluded' => 'gray',
                default => 'gray',
            })
            ->icon(fn (string $state): string => match ($state) {
                'draft' => 'heroicon-o-no-symbol',
                'reviewing' => 'heroicon-o-clock',
                'published' => 'heroicon-o-check-circle',
                'concluded' => 'heroicon-o-check',
            });
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContests::route('/'),
            'create' => Pages\CreateContest::route('/create'),
            'edit' => Pages\EditContest::route('/{record}/edit'),
        ];
    }

    public static function  getWidgets(): array
    {
        return [
             ContestOverview::class
        ];
    }
}
