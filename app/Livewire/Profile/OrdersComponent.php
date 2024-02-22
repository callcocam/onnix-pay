<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use NumberFormatter;

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
