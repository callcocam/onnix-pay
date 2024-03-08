<?php

namespace App\Livewire\Rifas;

use App\Models\Rifas\Rifa;
use App\Models\Rifas\Sales\Number;
use App\Models\Rifas\Sales\Sale;
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
        $totalNumbers = $this->rifa->quantity;
        $percentageSold = 0;
        $soldNumbers = 0;
        if ($sales = $this->rifa->sales) {
            $soldNumbers =  Number::query()
                ->whereIn('sale_id', $sales->pluck('id')->toArray())
                ->count();
            $percentageSold = ($soldNumbers / $totalNumbers) * 100;
        }

        return [
            'total' => sprintf('%0.2f', $percentageSold),
            'value' => str_pad($soldNumbers, strlen($totalNumbers), '0', STR_PAD_LEFT),
        ];
    }


    #[Computed]
    public function sales()
    {
        return $this->rifa->sales()->where('user_id', auth()->id())->get();
    }


    #[On('cart-number-updated')]
    public function updatedCartNumber($record = null) 
    {
         
        $this->sale =Sale::find($record);
    }

    public function render()
    {
        return view('livewire.rifas.show-component');
    }
}
