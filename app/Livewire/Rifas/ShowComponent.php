<?php

namespace App\Livewire\Rifas;

use App\Models\Rifas\Rifa;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ShowComponent extends Component
{

    public $rifa;

    public $sale;

    public function mount(Rifa $record)
    {
        $this->rifa = $record;
        $this->sale = $record->sale()->where('user_id', auth()->id())->first();
        $user = auth()->user();
        $user->load('address');
    }

    public function addCart()
    {
        if (!$this->rifa->sale()->where('user_id', auth()->id())->where('status', 'draft')->count()) {
            $this->rifa->sale()->create([
                'user_id' => auth()->id(),
                'status' => 'draft',
                'rifa_id' => $this->rifa->id,
                'description' => 'Rifa de ' . $this->rifa->name,
            ]); 
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



    public function render()
    {
        return view('livewire.rifas.show-component');
    }
}
