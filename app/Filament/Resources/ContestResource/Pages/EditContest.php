<?php

namespace App\Filament\Resources\ContestResource\Pages;

use App\Filament\Resources\ContestResource;
use Callcocam\Acl\Traits\HasDatesFormForTableColums;
use Callcocam\Acl\Traits\HasStatusColumn;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Forms\Components\TagsInput;
use Filament\Resources\Pages\EditRecord;

class EditContest extends EditRecord
{
    use HasStatusColumn, HasDatesFormForTableColums;
    
    protected static string $resource = ContestResource::class;

    public function form(Form $form): Form
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
                    TagsInput::make('description')
                    ->label('Dezenas')
                    ->columnSpanFull(),
                static::getStatusFormRadioField()
            ])->columns(3);
    }


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
