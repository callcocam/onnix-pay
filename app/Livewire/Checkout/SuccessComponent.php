<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Livewire\Checkout;
 
use App\Models\Rifas\Sales\Sale;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SuccessComponent extends Component
{

    public $sale;

    public function mount(Sale $sale)
    { 

        if (!$sale->exists) {
            return redirect()->route('home');
        }
 
        $this->sale = $sale;

    }

    #[Computed]
    public function dataOrder()
    {
        if(!$this->sale)
            return null;
        if($data = data_get($this->sale, 'data')){ 
            return json_decode($data, true);
        }
        return null;
    }

    public function render()
    {
        return view('livewire.checkout.pix.success-component');
    }
}
