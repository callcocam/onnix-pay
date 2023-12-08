<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Filament\Resources\Rifas;

use App\Filament\Resources\Rifas\CategoryResource\Pages;
use App\Filament\Resources\Rifas\CategoryResource\RelationManagers;
use App\Models\Rifas\Category;
use Callcocam\Acl\Traits\HasDatesFormForTableColums;
use Callcocam\Acl\Traits\HasStatusColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    use HasStatusColumn, HasDatesFormForTableColums;

    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->placeholder('Selecione uma categoria')
                    ->columnSpan([
                        'md' => 4
                    ]),
                Forms\Components\TextInput::make('name')
                    ->label('Nome da categoria')
                    ->required()
                    ->columnSpan([
                        'md' => 6
                    ])
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->options([
                        'product' => 'Produto',
                        'service' => 'Serviço',
                    ])
                    ->columnSpan([
                        'md' => 2
                    ]),
                Forms\Components\Textarea::make('description')
                    ->label('Descrição da categoria')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->label('Imagem da categoria')
                    ->image()
                    ->columnSpanFull(),
                Forms\Components\Radio::make('status')
                ->label('Status da categoria')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->inline()
                    ->columnSpanFull(),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([ 
                Tables\Columns\TextColumn::make('category.name')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(), 
                static::getStatusTableIconColumn(),
                ...static::getFieldDatesFormForTable(),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
