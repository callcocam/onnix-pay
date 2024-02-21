<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WinnerResource\Pages;
use App\Filament\Resources\WinnerResource\RelationManagers;
use App\Models\Contest;
use App\Models\Rifas\Rifa;
use App\Models\Rifas\Sales\Number;
use App\Models\Rifas\Sales\Sale;
use App\Models\Winner;
use Callcocam\Acl\Traits\HasDatesFormForTableColums;
use Callcocam\Acl\Traits\HasStatusColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WinnerResource extends Resource
{
    use HasStatusColumn, HasDatesFormForTableColums;

    protected static ?string $model = Winner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('contest_id')
                    ->label('Concurso')
                    ->options(Contest::query()->pluck('name', 'id')->toArray())->required()
                    ->columnSpan([
                        'sm' => 12,
                        'md' => 4,
                    ]),
                Forms\Components\Select::make('rifa_id')
                    ->label('Rifa')
                    ->reactive()
                    ->options(Rifa::query()->pluck('name', 'id')->toArray())->required()
                    ->columnSpan([
                        'sm' => 12,
                        'md' => 4,
                    ]),
                Forms\Components\Select::make('sale_id')
                    ->label('Venda')
                    ->reactive()
                    ->options(function (Get $get) {
                        return Sale::query()->where('rifa_id', $get('rifa_id'))->pluck('description', 'id')->toArray();
                    })->required()
                    ->columnSpan([
                        'sm' => 12,
                        'md' => 4,
                    ]),
                Forms\Components\Select::make('number_id')
                    ->label('Numero')
                    ->options(function (Get $get) {
                        return Number::query()->where('sale_id', $get('sale_id'))->pluck('number', 'id')->toArray();
                    })->required()
                    ->columnSpan([
                        'sm' => 12,
                        'md' => 4,
                    ]),
                Forms\Components\TextInput::make('number')
                    ->label('Número vencedor')
                    ->required()
                    ->maxLength(191)
                    ->columnSpan([
                        'sm' => 12,
                        'md' => 2,
                    ]),
                Forms\Components\DateTimePicker::make('delivery_at')
                    ->label('Data de entrega')
                    ->required()
                    ->columnSpan([
                        'sm' => 12,
                        'md' => 2,
                    ]),
                static::getStatusFormRadioField(),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sale.user.name')
                    ->label('Ganhador')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contest.name')
                    ->label('Concurso')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rifa.name')
                    ->label('Rifa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('number')
                    ->label('Número')
                    ->searchable(),
                Tables\Columns\TextColumn::make('delivery_at')
                    ->label('Data de entrega')
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
            'index' => Pages\ListWinners::route('/'),
            'create' => Pages\CreateWinner::route('/create'),
            'edit' => Pages\EditWinner::route('/{record}/edit'),
        ];
    }
}
