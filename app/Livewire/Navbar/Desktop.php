<?php

namespace App\Livewire\Navbar;

use App\Models\Rifas\Sales\Sale;
use Livewire\Attributes\On;
use Livewire\Component;

class Desktop extends Component
{
    public $cart = [];

    public function mount()
    {
        $this->cart = Sale::query()->where('user_id', auth()->id())->where('status', 'pending')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.navbar.desktop');
    }

    #[On('cart-updated')]
    public function updateCartList($data = [])
    {
        $this->cart[] = $data;
    }
}
