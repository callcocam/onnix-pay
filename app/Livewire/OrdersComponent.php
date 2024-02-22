<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;
use NumberFormatter;

class OrdersComponent extends Component
{
    public function render()
    {
        return view('livewire.orders-component');
    }

    #[Computed()]
    public function sales()
    {
        return auth()->user()->sales;
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
