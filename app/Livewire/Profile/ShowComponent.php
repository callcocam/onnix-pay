<?php

namespace App\Livewire\Profile; 
use Livewire\Component;

class ShowComponent extends Component
{ 


    public function render()
    {
        return view('livewire.profile.show-component', [
            'view' => request()->get('v', 'account')
        ]);
    }
}
