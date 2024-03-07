<?php

namespace App\Livewire\Profile;

use App\Services\Onixpay\Invoice;
use Livewire\Component;

class OrdersComponent extends Component
{

    public $sales;
 

    public function mount()
    {
        if (!auth()->check()) {
            return;
        }
        $this->sales = auth()->user()->sales; 

        if ($this->sales->count() > 0) {
            foreach ($this->sales as $sale) {
                if (in_array($sale->status, ['draft', 'pending', 'processing'])) {
                    $data = Invoice::make()->ref(data_get($sale->dataIvoice, 'reference'));
                    if ($data) {
                        $sale->status = strtolower(data_get($data, 'invoice.status', 'pending'));
                        $sale->save();
                        $sale->numbers->each(function ($number) use ($data) {
                            $number->status = strtolower(data_get($data, 'invoice.status', 'pending'));
                            $number->save();
                        });
                    }
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.profile.orders-component');
    }
}
