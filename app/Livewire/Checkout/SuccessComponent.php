<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Livewire\Checkout;

use App\Models\Order;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SuccessComponent extends Component
{

    public $order;

    public function mount($order)
    {
        $this->order = Order::find($order);

        if (!$this->order) {
            return redirect()->route('home');
        }

       
 

        $sales = $this->order->sales;

        $sales->each(function ($sale) {
            $sale->update([
                'status' => 'pending'
            ]);
        });

    }

    #[Computed]
    public function dataOrder()
    {
        if(!$this->order)
            return null;
        if($data = data_get($this->order, 'data')){ 
            return json_decode($data, true);
        }
        return null;
    }

    public function render()
    {
        $payment_method = $this->order->payment_method;
        if ($payment_method == 'pix') {
            return view('livewire.checkout.pix.success-component');
        }

        if ($payment_method == 'billet') {
            return view('livewire.checkout.billet.success-component');
        }

        if ($payment_method == 'credit_card') {
            return view('livewire.checkout.credit-card.success-component');
        }

        return view('livewire.checkout.success-component');
    }
}
