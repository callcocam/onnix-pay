<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use NumberFormatter;

class OrdersComponent extends Component
{

    public $orders;

    public function mount()
    {
        if (!auth()->check()) {
            return;
        }
        $this->orders = auth()->user()->orders;
    }

    public function render()
    {
        return view('livewire.profile.orders-component');
    }

    public function money($money, string $currency = 'BRL', int $divideBy = 0)
    {
        $formatter = new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY);

        if ($divideBy) {
            $money /= $divideBy;
        }

        return $formatter->formatCurrency($money, $currency);
    }
}
