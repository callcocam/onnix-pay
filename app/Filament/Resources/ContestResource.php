<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContestResource\Pages;
use App\Filament\Resources\ContestResource\RelationManagers;
use App\Models\Contest;
use Callcocam\Acl\Traits\HasDatesFormForTableColums;
use Callcocam\Acl\Traits\HasStatusColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome ou Número do Concuso')
                    ->maxLength(191),
                Forms\Components\TextInput::make('number')
                    ->label('Número do Concuso')
                    ->maxLength(191),
                Forms\Components\DateTimePicker::make('drawn_at')
                    ->label('Data do Sorteio')
                    ->required(),
                static::getStatusFormRadioField()
            ])->columns(3);
    }

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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContests::route('/'),
            'create' => Pages\CreateContest::route('/create'),
            'edit' => Pages\EditContest::route('/{record}/edit'),
        ];
    }
}
