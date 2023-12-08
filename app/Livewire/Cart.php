<?php

namespace App\Livewire;

use App\Models\Rifas\Sales\Sale;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{


    public $sales;

    public function mount(): void
    {
        $this->sales = Sale::query()->where('user_id', auth()->id())->where('status', 'pending')->get();
    }

    #[Computed]
    public function cartItems()
    {

        return  $this->sales;
    }

    #[Computed]
    public function total(): float
    {

        return  $this->sales->map(function ($sale) {
            return $sale->rifa->price * $sale->numbers->count();
        })->sum();;
    }

    public function checkout(): void
    {
        $this->dispatch('close-modal', ['id' => 'cart']);
        $this->dispatch('open-modal', ['id' => 'checkout']);
    }

    #[On('cart-updated')]
    public function updateCartList($data = [])
    {
        $this->sales = Sale::query()->where('user_id', auth()->id())->where('status', 'pending')->get();
    }

    #[On('cart-number-updated')]
    public function updateCartNumberList($data = [])
    {
        $this->sales = Sale::query()->where('user_id', auth()->id())->where('status', 'pending')->get();
    }


    public function render()
    {
        return view('livewire.cart');
    }
}
