<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard');
    }

    #[Computed]
    public function banner()
    {
        return \App\Models\Banner::query()->where('status', 'published')
            ->whereDate('start_date', '<=', now())
            ->orderBy('ordering', 'asc')
            ->first();
    }
}
