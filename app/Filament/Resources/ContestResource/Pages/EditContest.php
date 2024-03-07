<?php

namespace App\Filament\Resources\ContestResource\Pages;

use App\Core\Helpers\Helpers;
use App\Filament\Resources\ContestResource;
use App\Services\Loterias\MegaSena;
use Callcocam\Acl\Traits\HasDatesFormForTableColums;
use Callcocam\Acl\Traits\HasStatusColumn;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Forms\Components\TagsInput;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Route;

class EditContest extends EditRecord
{
    use HasStatusColumn, HasDatesFormForTableColums;

    protected static string $resource = ContestResource::class;


    public function mount(int|string $record): void
    {
        parent::mount($record); 
        //Se o status for rascunho, atualiza os dados do concurso, isso é feito para que o usuário não precise ficar atualizando os dados manualmente
        //Se o status for publicado, o usuário não pode atualizar os dados do concurso
        if (in_array($this->record->status, ['draft'])) {
            $data = MegaSena::make()->get($this->record->number);
            $date = Helpers::date_carbom_format(data_get($data, 'dataApuracao'));
            $description = data_get($data, 'listaDezenas');
            $status = 'published';

            $this->record->update([
                'drawn_at' => $date,
                'description' => $description,
                'status' => $status
            ]);
            $this->fillForm();
        }
    }

    public function form(Form $form): Form
    {



        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome ou Número do Concuso')
                    ->readOnly()
                    ->maxLength(191),
                Forms\Components\TextInput::make('number')
                    ->label('Número do Concuso')
                    ->readOnly()
                    ->maxLength(191),
                Forms\Components\DateTimePicker::make('drawn_at')
                    ->label('Data do Sorteio')
                    ->readOnly()
                    ->required(),
                TagsInput::make('description')
                ->disabled()
                    ->label('Dezenas')
                    ->columnSpanFull(),
                Forms\Components\Radio::make('status')
                    ->options(static::getStatuses())
                    ->disabled($this->record->status == 'completed')
                    ->required(),

            ])->columns(3);
    }

    public static function getStatuses(): array
    {
        return [
            'draft' => 'Rascunho',
            'published' => 'Publicado',
            'completed' => 'Concluído',
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
