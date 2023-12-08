<?php

namespace App\Livewire\Rifas;

use App\Models\Rifas\Rifa;
use Filament\Forms\FormsComponent;
use Livewire\Component;

class RifaComponent extends FormsComponent
{
    public $record;

    public function mount(Rifa $rifa)
    {
        $this->record = $rifa;
    }
    
    public function render()
    {
        return view('livewire.rifas.rifa-component');
    }
}
