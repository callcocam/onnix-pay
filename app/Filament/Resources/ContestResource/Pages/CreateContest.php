<?php

namespace App\Filament\Resources\ContestResource\Pages;

use App\Core\Helpers\Helpers;
use App\Filament\Resources\ContestResource;
use App\Models\Contest;
use App\Services\Loterias\MegaSena;
use Callcocam\Acl\Traits\HasDatesFormForTableColums;
use Callcocam\Acl\Traits\HasStatusColumn;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Forms\Components\TagsInput;
use Filament\Resources\Pages\CreateRecord;
use Symfony\Component\Console\Helper\Helper;

class CreateContest extends CreateRecord
{
    use HasStatusColumn, HasDatesFormForTableColums;

    protected static string $resource = ContestResource::class;


    public function form(Form $form): Form
    {
        $data = MegaSena::make()->get();

        $date = Helpers::date_carbom_format(data_get($data, 'dataProximoConcurso'));
        $numero = data_get($data, 'numeroConcursoProximo', 0);

        $description = [];
        $status = 'published';
        if (!Contest::where('number', data_get($data, 'numero'))->exists()) {
            $numero = data_get($data, 'numero');
            $date = Helpers::date_carbom_format(data_get($data, 'dataApuracao'));
            $description = data_get($data, 'listaDezenas');
            $status = 'concluded';
        }

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome ou Número do Concuso')
                    ->default(sprintf('Concurso %s - %s', $numero, $date->format('d/m/Y')))
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('number')
                    ->default($numero)
                    ->label('Número do Concuso')
                    ->readOnly()
                    ->maxLength(191),
                Forms\Components\DatePicker::make('drawn_at')
                    ->default($date->format('Y-m-d'))
                    ->label('Data do Sorteio')
                    ->readOnly()
                    ->required(),
                TagsInput::make('description')
                    ->label('Dezenas')
                    ->default($description)

                    ->columnSpanFull(),
                Forms\Components\Radio::make('status')
                    ->options(static::getStatuses()) 
                    ->default($status)
                    ->required(),
            ])->columns(3);
    }
}
