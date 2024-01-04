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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->columnSpan([
                        'md' => 4
                    ])
                    ->relationship('category', 'name'),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->columnSpan([
                        'md' => 8
                    ])
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                static::getUploadFormFieldset('image')
                    ->columnSpanFull(),
                Forms\Components\Radio::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->required()
                    ->columnSpanFull()
                    ->inline()
                    ->default('draft'),
                Forms\Components\Select::make('type')
                    ->options([
                        'free' => 'Free',
                        'paid' => 'Paid',
                    ])
                    ->required()
                    ->columnSpan([
                        'md' => 3
                    ])
                    ->default('free'),
                Money::make('price')
                    ->columnSpan([
                        'md' => 3
                    ]),
                Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->columnSpan([
                        'md' => 3
                    ])
                    ->default(1)
                    ->minValue(1),
                Forms\Components\DatePicker::make('start_date')
                    ->columnSpan([
                        'md' => 3
                    ]),
                Forms\Components\DatePicker::make('end_date')
                    ->columnSpan([
                        'md' => 3
                    ]),
                Forms\Components\DatePicker::make('draw_date')
                    ->columnSpan([
                        'md' => 3
                    ]),
                Forms\Components\TimePicker::make('draw_time')
                    ->columnSpan([
                        'md' => 3
                    ]),
                Forms\Components\Textarea::make('draw_local')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('draw_local_link')
                    ->columnSpanFull()
                    ->maxLength(255),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('BRL')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->searchable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->searchable(),
                Tables\Columns\TextColumn::make('draw_date')
                    ->date()
                    ->searchable(),
                Tables\Columns\TextColumn::make('draw_time')
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
