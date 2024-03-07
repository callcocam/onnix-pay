<?php

namespace App\Livewire;

use Livewire\Component;


class Footer extends Component
{

    public $about = 1;
    
    public function render()
    {
        return view('livewire.footer');
    }
}
