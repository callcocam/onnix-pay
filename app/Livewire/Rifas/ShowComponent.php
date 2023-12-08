<?php

namespace App\Livewire\Rifas;

use App\Models\Rifas\Rifa;
use Livewire\Component;

class ShowComponent extends Component
{

    public $rifa;

    public $sale;

    public function mount(Rifa $record)
    {
        $this->rifa = $record;
        $this->sale = $record->sale ; 
        $user = auth()->user();
        $user->load('address');  
    }

    public function addCart()
    {
        if (!$this->rifa->sale()->where('user_id', auth()->id())->where('status', 'pending')->count()) {
            $this->rifa->sale()->create([
                'user_id' => auth()->id(),
                'status' => 'pending',
                'rifa_id' => $this->rifa->id,
                'description' => 'Rifa de ' . $this->rifa->name,
            ]);
            $this->dispatch('cart-updated');
        }
    }

    public function render()
    {
        return view('livewire.rifas.show-component');
    }
}
