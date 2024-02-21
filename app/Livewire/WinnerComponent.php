<?php

namespace App\Livewire;

use Livewire\Component;

class WinnerComponent extends Component
{

    public $winner;

    public function mount($winner)
    {
        $this->winner = $winner; 
    }

    public function render()
    {
        return view('livewire.winner-component');
    }
}
