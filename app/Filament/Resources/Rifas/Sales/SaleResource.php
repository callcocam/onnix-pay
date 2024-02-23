<?php

namespace App\Filament\Resources\Rifas\Sales;

use App\Filament\Resources\Rifas\Sales\SaleResource\Pages;
use App\Filament\Resources\Rifas\Sales\SaleResource\RelationManagers;
use App\Models\Cupon;
use App\Models\Rifas\Rifa;
use App\Models\Rifas\Sales\Sale;
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
use Leandrocfe\FilamentPtbrFormFields\Money;

class SaleResource extends Resource
{
    use HasStatusColumn, HasDatesFormForTableColums;

    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Select::make('cupon_id')
                    ->label('Cupom')
                    ->options(Cupon::query()
                        ->pluck('name', 'id')
                        ->toArray())->columnSpan([
                        'md' => 3
                    ]),
                Forms\Components\TextInput::make('rifa_name')
                    ->label('Rifa')
                    ->readOnly()
                    ->formatStateUsing(function (Sale $record) {
                        if ($rifa = $record->rifa) {
                            return $rifa->name;
                        }
                        return "";
                    })->columnSpan([
                        'md' => 4
                    ]),
                Forms\Components\TextInput::make('invoice')
                    ->label('Fatura')
                    ->readOnly()
                    ->columnSpan([
                        'md' => 3
                    ]),
                Forms\Components\TextInput::make('quantity')
                    ->label('Quantidade')
                    ->readOnly()
                    ->required()
                    ->columnSpan([
                        'md' => 2
                    ])
                    ->numeric()
                    ->default(0),
                Money::make('subtotal')
                    ->readOnly()
                    ->label('Subtotal')
                    ->required()
                    ->columnSpan([
                        'md' => 3
                    ])
                    ->default(0.00),
                Money::make('discount')
                    ->label('Desconto')
                    ->readOnly()
                    ->columnSpan([
                        'md' => 3
                    ])
                    ->default(0.00),
                Money::make('shipping')
                    ->label('Frete')
                    ->readOnly()
                    ->columnSpan([
                        'md' => 3
                    ])
                    ->default(0.00),
                Money::make('total')
                    ->label('Total')
                    ->readOnly()
                    ->required()
                    ->columnSpan([
                        'md' => 3
                    ])
                    ->default(0.00),
                Forms\Components\Radio::make('payment_method')
                    ->required()
                    ->disabled()
                    ->options([
                        'pix' => 'Pix',
                        'credit_card' => 'Cartão de Crédito',
                        'debit_card' => 'Cartão de Débito',
                        'bank_slip' => 'Boleto Bancário',
                    ])->columnSpanFull()
                    ->inline()
                    ->default('pix'),
                Forms\Components\Textarea::make('data')
                    ->columnSpanFull(),
                static::getStatusFormRadioField()
            ])->columns(12);
    }


    public static function getStatuses(): array
    {
        return [
            'draft' => 'Rascunho',
            'published' => 'Publicado',
            'canceled' => 'Cancelado',
            'pending' => 'Pendente',
            'processing' => 'Processando',
            'paid' => 'Pago',
            'completed' => 'Completo',
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Cliente')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rifa.name')
                    ->label('Rifa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->money('BRL')
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount')
                    ->label('Desconto')
                    ->money('BRL')
                    ->sortable(),
                Tables\Columns\TextColumn::make('shipping')
                    ->label('Frete')
                    ->money('BRL')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->money('BRL')
                    ->sortable(),
                static::getStatusTableIconColumn(),
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

    public static function getStatusTableIconColumn(): IconColumn
    {
        return  IconColumn::make('status')
            ->label(static::getStatusColumnLabel())
            ->color(fn (string $state): string => match ($state) {
                'draft' => 'danger',
                'reviewing' => 'warning',
                'published' => 'success',
                'canceled' => 'danger',
                'pending' => 'warning',
                'processing' => 'info',
                'paid' => 'success',
                'completed' => 'success',
                default => 'gray',
            })
            ->icon(fn (string $state): string => match ($state) {
                'draft' => 'heroicon-o-no-symbol',
                'reviewing' => 'heroicon-o-clock',
                'published' => 'heroicon-o-check-circle',
                'canceled' => 'heroicon-o-x-circle',
                'pending' => 'heroicon-o-exclamation-circle',
                'processing' => 'heroicon-o-refresh',
                'paid' => 'heroicon-o-currency-dollar',
                'completed' => 'heroicon-o-check-circle',
            });
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
            'index' => Pages\ListSales::route('/'),
            'create' => Pages\CreateSale::route('/create'),
            'edit' => Pages\EditSale::route('/{record}/edit'),
        ];
    }
}
