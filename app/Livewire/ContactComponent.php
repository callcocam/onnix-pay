<?php

namespace App\Livewire;

use Laravel\Cashier\Cashier;
use Livewire\Component;

class ContactComponent extends Component
{

    public function mount()
    {
        $user = auth()->user();
    //     if (!$user->stripe_id) {
    //         $stripeCustomer = $user->createAsStripeCustomer();
    //     }else{
    //         $stripeCustomer = $user->asStripeCustomer();
    //     } 
    //     $balance = $user->balance();
    //    dd($balance);
    }
    public function render()
    {
        return view('livewire.contact-component');
    }
}
