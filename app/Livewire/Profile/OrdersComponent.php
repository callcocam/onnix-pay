<?php

namespace App\Livewire\Profile;

use App\Services\Onixpay\Invoice;
use Livewire\Component;

class OrdersComponent extends Component
{

    public $sales;

    public $orderPending;

    public function mount()
    {
        if (!auth()->check()) {
            return;
        }
        $this->sales = auth()->user()->orderPaid;

        $this->orderPending = auth()->user()->orderPending;

        if ($this->orderPending->count() > 0) {
            foreach ($this->orderPending as $order) {
                if (in_array($order->status, ['draft', 'pending', 'processing'])) {
                    $data = Invoice::make()->ref(data_get($order->dataIvoice, 'reference'));
                    if ($data) {
                        $order->status = strtolower(data_get($data, 'invoice.status', 'pending'));
                        $order->save();
                        $order->numbers->each(function ($number) use ($data) {
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
