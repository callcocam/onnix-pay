<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Livewire;

use App\Models\Rifas\Rifa;
use App\Models\Winner;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SorteioComponent extends Component
{

    public $sorteio;

    public $rifa;

    public $sales;

    public $sale;

    public $winner;

    public function mount(Rifa $rifa)
    { 
        $this->rifa = $rifa;

        $this->sorteio = $rifa->contest; 

        $this->sales = $rifa->sales()->where('user_id', auth()->id())->get(); 

        $this->winner = Winner::query()->whereIn('sale_id', $this->sales->pluck('id'))->first();

        if ($this->winner) {
            $this->sale = $this->winner->sale;
        } 
        
    } 

    public function render()
    {
        if ($this->sorteio) {
            if ($this->sorteio->description) {
                return view('livewire.sorteio-winnwer-component');
            }
        }
        return view('livewire.sorteio-component');
    }

    #[Computed]
    public function numbers()
    { 
        if ($this->sale)
            return $this->sale->numbers->pluck('number')->map(fn ($n) => str($n)->padLeft(2, '0')->toString())->toArray();
        return [];
    }

    
}
