<?php

namespace App\Filament\Resources\ContestResource\Widgets;

use App\Services\Loterias\MegaSena;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContestOverview extends BaseWidget
{
    protected function getColumns(): int
    { 
        

        return 2;
    }

    protected function getConsurso(): array
    {
        //numeroConcursoAnterior
        //numeroConcursoProximo
        //dataApuracao
        //dataProximoConcurso
         
        return MegaSena::make()->get();
    }

    protected function getStats(): array
    {
       $data = $this->getConsurso(); 
        return [ 
            Stat::make('Último concurso',data_get($data,'numero')) 
            ->description(sprintf('Sorteio realizado em %s', data_get($data,'dataApuracao')))
            ->color('success'),
            Stat::make('Próximo concurso', $data['numeroConcursoProximo'])
            ->description(sprintf('Sorteio previsto para %s', data_get($data,'dataProximoConcurso')))
            ->color('info'),
        ];
    }
}
