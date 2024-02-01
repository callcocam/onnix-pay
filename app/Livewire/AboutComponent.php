<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class AboutComponent extends Component
{
    public function render()
    {
        return view('livewire.about-component');
    }

    #[Computed]
    public function abouts()
    {
        return \App\Models\About::query()->where('status', 'published')->get();
    }
}
