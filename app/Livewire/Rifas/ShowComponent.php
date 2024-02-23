<?php

namespace App\Livewire\Rifas;

use App\Models\Rifas\Rifa;
use App\Models\Winner;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowComponent extends Component
{

    public $rifa;

    public $sale;

    public $sorteio;

    public $winners;

    public function mount(Rifa $record)
    {
        $this->rifa = $record;
        $this->sale = $record->currentSale;
        $user = auth()->user();
        $user->load('address');

        if ($this->rifa->contest) {
            $this->sorteio = $this->rifa->contest;

            $this->winners = Winner::query()
                ->whereIn('sale_id', $this->rifa->sales->pluck('id')->toArray())
                ->get();
        }
    }
 
    #[Computed]
    public function numberProgress()
    {
        $totalNumbers = $this->rifa->total;
        $percentageSold = 0;
        if ($sale = $this->rifa->sale) {
            if ($sale->numbers->count() >= $this->rifa->quantity) {
                $soldNumbers = $this->rifa->sales->count() * $this->rifa->price;
                $percentageSold = ($soldNumbers / $totalNumbers) * 100;
            }
        }

        return sprintf('%0.2f', $percentageSold);
    }


    #[Computed]
    public function sales()
    {
        return $this->rifa->sales()->where('user_id', auth()->id())->get();
    }
 

    #[On('cart-number-updated')]
    public function updatedCartNumber()
    {
    }

    public function render()
    {
        return view('livewire.rifas.show-component');
    }
}
