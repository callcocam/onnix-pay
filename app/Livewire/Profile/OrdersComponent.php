<?php

namespace App\Livewire\Profile;

use App\Services\Onixpay\Invoice;
use Livewire\Component;

class OrdersComponent extends Component
{

    public $sales;
 

    public function mount()
    {
        if (!auth()->check()) {
            return;
        }
        $this->sales = auth()->user()->sales; 

       
    }

    public function render()
    {
        return view('livewire.profile.orders-component');
    }
}
