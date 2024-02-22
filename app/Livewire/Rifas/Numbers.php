<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Livewire\Rifas;

use Livewire\Attributes\Computed;
use Livewire\Component;

class Numbers extends Component
{

    public $rifa;

    public $sale;

    public $numbers = [];

    public $pending = [];

    public $pay = [];

    public function mount($rifa)
    {
        $this->rifa = $rifa;


        $this->sale = $this->rifa->sale()->where('user_id', auth()->id())->first();

        if ($this->sale) {
            $this->numbers = $this->sale->numbers()->where('user_id', auth()->id())->pluck('number')->toArray();
            $this->pending = $this->sale->numbers()->where('status', 'pending')->pluck('number')->toArray();
            $this->pay = $this->sale->numbers()->where('status', 'pay')->pluck('number')->toArray();
        }
    }



    public function addNumber($number)
    {
        if (!$this->sale) {
            $this->sale = auth()->user()->sales()->create([
                'rifa_id' => $this->rifa->id,
                'description' => 'Rifa de ' . $this->rifa->name,
                'invoice' =>  $this->rifa->code,
                'quantity' => 1,
                'total' => $this->rifa->price,
                'subtotal' => $this->rifa->price,
                'discount' => 0,
                'shipping' => 0,
                'status' => 'draft'
            ]);
        }


        if (!$this->sale->numbers()
            ->where('user_id', auth()->id())
            ->where('status', 'pending')
            ->where('number', $number)->count()) {
            $this->sale->numbers()->create([
                'user_id' => auth()->id(),
                'status' => 'pending',
                'number' => $number,
                'rifa_id' => $this->rifa->id,
                'description' => 'Rifa de ' . $this->rifa->name,
            ]);

            $this->sale->quantity = count($this->numbers) + 1;
            $this->sale->save();
            $this->dispatch('cart-number-updated');
            $this->numbers = $this->sale->numbers()->where('user_id', auth()->id())->pluck('number')->toArray();
            $this->pending = $this->sale->numbers()->where('status', 'pending')->pluck('number')->toArray();
            $this->pay = $this->sale->numbers()->where('status', 'pay')->pluck('number')->toArray();
        }
    }

    public function removeNumber($number)
    {
        $this->sale->numbers()
            ->where('user_id', auth()->id())
            ->where('status', 'pending')
            ->where('number', $number)->forceDelete(); 
        $this->sale->quantity = count($this->numbers) - 1;
        $this->sale->save();
        $this->numbers = $this->sale->numbers()->where('user_id', auth()->id())->pluck('number')->toArray();
        $this->pending = $this->sale->numbers()->where('status', 'pending')->pluck('number')->toArray();
        $this->pay = $this->sale->numbers()->where('status', 'pay')->pluck('number')->toArray();
    }

    #[Computed]
    public function quantity()
    {
        return $this->rifa->quantity;
    }

    #[Computed]
    public function livres()
    {
        return  $this->quantity() - count($this->numbers);
    }

    #[Computed]
    public function reservados()
    {
        return   count($this->pending);
    }
    #[Computed]
    public function pagos()
    {
        return   count($this->pay);
    }

    #[Computed]
    public function total()
    {
        return   $this->sales->number->count();
    }

    public function render()
    {
        return view('livewire.rifas.numbers');
    }
}
