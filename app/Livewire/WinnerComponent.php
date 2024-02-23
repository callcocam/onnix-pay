<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class WinnerComponent extends Component
{

    public $winner;

    public $sale;

    public $rifa;

    public function mount($winner)
    {
        $this->winner = $winner;

        $this->sale = $winner->sale;

        $this->rifa = $this->sale->rifa;
    }

    public function render()
    {
        return view('livewire.winner-component');
    }

    #[Computed]
    public function numbers()
    {
        return $this->sale->numbers->pluck('number')->map(fn ($n) => str($n)->padLeft(2, '0')->toString())->toArray();
    }
}
