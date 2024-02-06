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
        if (!auth()->check()) {
            return;
        }
        
    }

    #[Computed]
    public function cartItems()
    {

        $this->sales = auth()->user()->sales()->whereIn('status', ['pending', 'draft'])->get(); 

        return  $this->sales;
    }

    #[Computed]
    public function total(): float
    {

        return  $this->sales->map(function ($sale) {
            return $sale->rifa->price * $sale->numbers->count();
        })->sum();
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

    public function removeItem($id)
    {
        $sale = Sale::find($id);
        $sale->delete();
        $this->updateCartList();
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
