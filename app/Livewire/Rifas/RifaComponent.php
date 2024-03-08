<?php

namespace App\Livewire\Rifas;

use App\Models\Rifas\Rifa;
use Carbon\Carbon;
use Filament\Forms\FormsComponent;
use Livewire\Attributes\Computed;
use Livewire\Component;

class RifaComponent extends FormsComponent
{
    public $rifa;

    public $numbers = [];

    public $pending = [];

    public $pay = [];

    public $sale;

    public function mount(Rifa $rifa)
    {
        $this->rifa = $rifa;

        $this->sale = $this->rifa->sale;

        if ($this->sale) {
            $this->numbers = $this->sale->numbers()->where('user_id', auth()->id())->pluck('number')->toArray();
            $this->pending = $this->sale->numbers()->where('status', 'pending')->pluck('number')->toArray();
            $this->pay = $this->sale->numbers()->where('status', 'paid')->pluck('number')->toArray();
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
    public function concorentes()
    {
        return  $this->rifa->sales->count();
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
    public function diffDays()
    {
        $now = now();
        $date = Carbon::create($this->rifa->end_date);
        $year = $date->year;
        $month = $date->month;
        $day = $date->day; 
        $date = Carbon::create($year, $month, $day, null, null, null, null);
        $countdown = \App\Core\Helpers\Countdown\Facades\CountdownFacade::from($now)
            ->to($date)->get();


        return $countdown->days;
    }
    public function render()
    {
        return view('livewire.rifas.rifa-component');
    }
}
