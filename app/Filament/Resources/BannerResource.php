<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Filament\Resources\BannerResource\RelationManagers;
use App\Models\Banner;
use Callcocam\Tenant\Traits\HasUploadFormField;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BannerResource extends Resource
{
    use HasUploadFormField;

    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->columnSpanFull()
                    ->maxLength(255),
                static::getUploadFormFieldset('image')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('link')
                    ->columnSpan([
                        'md' => 7
                    ])
                    ->maxLength(255),
                Forms\Components\Select::make('rifa_id')
                    ->columnSpan([
                        'md' => 5
                    ])
                    ->relationship('rifa', 'name'),

                Forms\Components\DatePicker::make('start_date')
                    ->columnSpan([
                        'md' => 3
                    ]),
                Forms\Components\DatePicker::make('end_date')
                    ->columnSpan([
                        'md' => 3
                    ]),
                Forms\Components\TextInput::make('ordering')
                    ->columnSpan([
                        'md' => 3
                    ])
                    ->numeric(),
                Forms\Components\TextInput::make('clicks')
                    ->columnSpan([
                        'md' => 3
                    ])
                    ->numeric(),
                Forms\Components\Radio::make('status')
                    ->options([
                        'published' => 'Published',
                        'draft' => 'Draft',
                    ])
                    ->inline()
                    ->columnSpanFull()
                    ->default('published'),
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([ 
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('link')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->searchable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ordering')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('clicks')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
