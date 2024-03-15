<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Livewire\Rifas;

use App\Models\Rifas\Sales\Number;
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

    #[Computed]
    public $perPage = 1;

    public function upLoadMore()
    {
        $this->perPage += 200;
    }

    public function downLoadMore()
    {
        $this->perPage -= 200;
    }

    public function mount($rifa)
    {
        $this->rifa = $rifa;
        $this->sale = $this->rifa->currentSale;
        // $this->sale->numbers()->forceDelete(); 
        $this->updatedNumbers();
    }

    public function updatedNumbers()
    {
        $numbers = Number::query()
            ->whereIn('sale_id', $this->rifa->sales->pluck('id')->toArray())
            ->get();

        $this->numbers = $numbers->filter(fn ($item) =>  $item->user_id == auth()->id())->pluck('number')->toArray();
        $this->pending = $numbers->filter(fn ($item) => in_array($item->status, ['pending']))->pluck('number')->toArray();
        $this->pay = $numbers->filter(fn ($item) => in_array($item->status, ['paid', 'approved']))->pluck('number')->toArray();
        $this->draft = $numbers->filter(fn ($item) => in_array($item->status, ['draft']))->pluck('number')->toArray();
        
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

    #[On('add-number')]
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
            ->whereIn('status', ['draft', 'pending'])
            ->where('number', $number)->count()) {
            $this->sale->numbers()->create([
                'user_id' => auth()->id(),
                'status' => 'draft',
                'number' => $number,
                'rifa_id' => $this->rifa->id,
                'description' => 'Rifa de ' . $this->rifa->name,
            ]);

            $quantity = count($this->draft) + 1;
            $val = $this->rifa->price * $quantity;

            $this->sale->update([
                'quantity' =>  $quantity,
                'total' => $val,
                'subtotal' => $val
            ]);
            $this->updatedNumbers();
            $this->dispatch('cart-number-updated',  $this->sale->id );
        }
    }


    public function removeNumber($number)
    {
        $this->sale->numbers()
            ->where('user_id', auth()->id())
            ->where('status', 'draft')
            ->where('number', $number)->forceDelete();
        $quantity = count($this->numbers) - 1;
        $val = $this->rifa->price * $quantity;
        $this->sale->update([
            'quantity' => $quantity,
            'total' => $val,
            'subtotal' => $val
        ]);
        $this->updatedNumbers();
        $this->dispatch('cart-number-updated',  $this->sale->id);
    }

    #[Computed]
    public function quantity()
    { 
        $quantities = $this->rifa->quantity;
         
        return $quantities;
    }

    #[Computed]
    public function livres()
    {
        return  $this->quantity() - count($this->numbers);
    }

    #[Computed]
    public function reservados()
    {
        return  count($this->draft);
    }

    #[Computed]
    public function pagos()
    {
        return count($this->pay);
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
