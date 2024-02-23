<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Livewire\Rifas;

use Filament\Notifications\Notification;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Numbers extends Component
{

    public $rifa;

    public $sale;

    public $numbers = [];

    public $pending = [];

    public $pay = [];

    public $draft = [];

    public $errorDuplicate = false;

    public function mount($rifa)
    {
        $this->rifa = $rifa;


        $this->sale = $this->rifa->currentSale;
        // $this->sale->numbers()->forceDelete();
        if ($this->sale) {
            $this->numbers = $this->sale->numbers()->where('user_id', auth()->id())->pluck('number')->toArray();
            $this->pending = $this->sale->numbers()->where('status', 'pending')->pluck('number')->toArray();
            $this->pay = $this->sale->numbers()->where('status', 'pay')->pluck('number')->toArray();
            $this->draft = $this->sale->numbers()->where('status', 'draft')->pluck('number')->toArray();  
        }
    }


    #[On('erro-nunber')]
    public function erroNunber($number)
    { 

        Notification::make()
            ->title('Erro')
            ->body($number)
            ->danger()
            ->send();
    }

    #[On('clear-error')]
    public function clearError()
    { 
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
                'status' => 'draft',
                'number' => $number,
                'rifa_id' => $this->rifa->id,
                'description' => 'Rifa de ' . $this->rifa->name,
            ]);


            $this->sale->quantity = count($this->numbers) + 1;
            $this->sale->save();
            $this->numbers = $this->sale->numbers()->where('user_id', auth()->id())->pluck('number')->toArray();
            $this->pending = $this->sale->numbers()->where('status', 'pending')->pluck('number')->toArray();
            $this->pay = $this->sale->numbers()->where('status', 'pay')->pluck('number')->toArray();
            $this->draft = $this->sale->numbers()->where('status', 'draft')->pluck('number')->toArray();
            $this->dispatch('cart-number-updated');

            
            if($this->hasRifa()){
                $this->dispatch('erro-nunber', 'Você já comprou uma rifa com esses números, selecione outros números');
                return $this->removeNumber($number);
            }
        }
    }

    public function hasRifa()
    {
        $result = true;
        $drafts = $this->sale->numbers()->where('status', 'draft')->pluck('number')->toArray();
        if (count($drafts) >= $this->rifa->quantity) {
            foreach ($this->rifa->sales as $sale) {
                $winningNumber = $sale->numbers->pluck('number')->toArray(); 
                foreach ($drafts as $draft) {
                    if (!in_array($draft, $winningNumber)) {
                        $result = false;
                    }
                }
            }
            if ($result) { 
                return $result;
            }
            $this->dispatch('clear-error');
            return $result;
        }
        return false;
    }

    public function removeNumber($number)
    {
        $this->sale->numbers()
            ->where('user_id', auth()->id())
            ->where('status', 'draft')
            ->where('number', $number)->forceDelete(); 
        $this->sale->quantity = count($this->numbers) - 1;
        $this->sale->save();
        $this->numbers = $this->sale->numbers()->where('user_id', auth()->id())->pluck('number')->toArray();
        $this->pending = $this->sale->numbers()->where('status', 'pending')->pluck('number')->toArray();
        $this->pay = $this->sale->numbers()->where('status', 'pay')->pluck('number')->toArray();
        $this->draft = $this->sale->numbers()->where('status', 'draft')->pluck('number')->toArray();        
        $this->dispatch('cart-number-updated');
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
