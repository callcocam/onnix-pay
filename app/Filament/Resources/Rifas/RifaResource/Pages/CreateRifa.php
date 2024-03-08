<?php

namespace App\Filament\Resources\Rifas\RifaResource\Pages;

use App\Filament\Resources\Rifas\RifaResource;
use App\Models\Rifas\Rifa;
use Callcocam\Tenant\Traits\HasUploadFormField;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Forms\Set;
use Filament\Resources\Pages\CreateRecord;
use Leandrocfe\FilamentPtbrFormFields\Money;

class CreateRifa extends CreateRecord
{
    use HasUploadFormField;

    protected static string $resource = RifaResource::class;

    protected static function IniciasNomes($String)
    {
        if (empty($String)) {
            return '';
        }
        $Nome = preg_split("/((de|da|do|dos|das|e|as|As|a|o|£|ou|é|&|o|os)?)[\s,_-]+/", $String);
        $Iniciais = "";
        foreach ($Nome as $N) {
            if (strlen($N) > 0) {
                $Iniciais .= $N[0];
            }
        }
        return sprintf("%s-%s", $Iniciais, rand(1, 99));
    }

    public function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->label('Categoria')
                    ->columnSpan([
                        'md' => 3
                    ])
                    ->relationship('category', 'name'),
                Forms\Components\TextInput::make('name')
                    ->label('Nome da rifa')
                    ->required()
                    ->columnSpan([
                        'md' => 7
                    ])
                    ->maxLength(255)->live(true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('code', self::IniciasNomes($state))),
                Forms\Components\TextInput::make('code')
                    ->label('Código da rifa')
                    ->required()
                    ->readOnly()
                    ->columnSpan([
                        'md' => 2
                    ]),
                Forms\Components\Textarea::make('preview')
                    ->label('Prévia')
                    ->columnSpanFull(),
                static::getUploadFormFieldset('image'),
                Forms\Components\FileUpload::make('gallery')
                    ->label('Galeria')
                    ->multiple()
                    ->columnSpanFull()
                    ->image(),
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
                    ->label('Tipo')
                    ->options([
                        'free' => 'Gratis',
                        'paid' => 'Pago',
                    ])
                    ->required()
                    ->columnSpan([
                        'md' => 3
                    ])
                    ->default('free'),
                Money::make('price')
                    ->label('Valor da rifa')
                    ->columnSpan([
                        'md' => 3
                    ]),
                Forms\Components\TextInput::make('quantity')
                    ->label('Quantidade de números')
                    ->numeric()
                    ->columnSpan([
                        'md' => 3
                    ])
                    ->default(1)
                    ->minValue(1),
                //total
                Money::make('total')
                    ->label('Valor total')
                    ->columnSpan([
                        'md' => 3
                    ])
                    ->default(0),
                Forms\Components\DatePicker::make('start_date')
                    ->label('Data inicial da competição')
                    ->columnSpan([
                        'md' => 3
                    ]),
                Forms\Components\DatePicker::make('end_date')
                    ->label('Data final da competição')
                    ->columnSpan([
                        'md' => 3
                    ]),
                // Forms\Components\DatePicker::make('draw_date')
                //     ->label('Data do sorteio')
                //     ->columnSpan([
                //         'md' => 4
                //     ]),
                // Forms\Components\TimePicker::make('draw_time')
                //     ->label('Hora do sorteio')
                //     ->columnSpan([
                //         'md' => 4
                //     ]),
                Forms\Components\Select::make('contest_id')
                    ->label('Concurso')
                    ->relationship('contest', 'name')
                    ->columnSpan([
                        'md' => 6
                    ]),
                Forms\Components\Textarea::make('draw_local')
                    ->label('Local do sorteio')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('draw_local_link')
                    ->label('Link do sorteio')
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->label('Descrição')
                    ->columnSpanFull(),
            ])->columns(12);
    }
}
