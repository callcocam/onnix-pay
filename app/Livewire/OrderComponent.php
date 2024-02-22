<?php

namespace App\Livewire;

use App\Models\Rifas\Sales\Sale;
use Livewire\Attributes\Computed;
use Livewire\Component;

class OrderComponent extends Component
{

    public $sale;

    public function mount(Sale $sale): void
    {
        if (!auth()->check()) {
            return;
        }
 
        $this->sale = $sale;
    }
    
    #[Computed]
    public function cartItems()
    {
        if (!auth()->check()) {
            return collect([]);
        }
        

        return  $this->sale->numbers;
    }

    public function render()
    {
        return view('livewire.order-component');
    }
}
