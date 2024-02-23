<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Livewire;

use App\Models\Rifas\Rifa;
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

        

        $this->winner = $this->sale;

        if (Carbon::parse($rifa->end_date)->diffInDays()) {
            if ($sales = $rifa->sales) { 
                foreach ($sales as $sale) {
                    $this->winner($sale);
                }
            }
        }
    }


    #[Computed]
    public function winners()
    {
        return \App\Models\Winner::query()
            ->where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();
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

    #[Computed]
    public function winner($sale)
    {
        $myNumbers = $this->numbers();

        if (!$this->sorteio) {
            return;
        }
        $winningNumber = $this->sorteio->description;

        if (empty(array_diff($myNumbers, $winningNumber)) && empty(array_diff($winningNumber, $myNumbers))) {
            if ($sale->winner()->count()) {
                return;
            }
            $this->sale->winner()->create([
                'user_id' => $sale->user_id,
                'delivery_at' => Carbon::parse($this->sorteio->drawn_at)->addDays(7)->format('Y-m-d H:i:s'),
                'status' => 'published',
                'description' => "Parabéns você é o ganhador do sorteio {$this->sorteio->name}"
            ]);
        }
    }
}
