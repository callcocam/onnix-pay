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

        $this->sale = $this->rifa->sale;

        if ($this->sale) {
            $this->numbers = $this->sale->numbers()->where('user_id', auth()->id())->pluck('number')->toArray();
            $this->pending = $this->sale->numbers()->where('status', 'pending')->pluck('number')->toArray();
            $this->pay = $this->sale->numbers()->where('status', 'pay')->pluck('number')->toArray();
        }
    }

    public function addNumber($number)
    {
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

            $this->numbers = $this->sale->numbers()->where('user_id', auth()->id())->pluck('number')->toArray();
            $this->pending = $this->sale->numbers()->where('status', 'pending')->pluck('number')->toArray();
            $this->pay = $this->sale->numbers()->where('status', 'pay')->pluck('number')->toArray();
        }
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

    public function render()
    {
        return view('livewire.rifas.numbers');
    }
}
