<?php

namespace App\Livewire;

use App\Models\Rifas\Rifa;
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

    #[Computed]
    public function winners()
    {
        return \App\Models\Winner::query()
            ->where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();
    }

    #[Computed]
    public function  rifas()
    {
        return Rifa::query()
            ->where('status', 'published')
            ->whereDate('start_date', '<=', now())
            // ->whereDate('end_date', '>=', now()->addDays(10)) 
            ->orderBy('ordering', 'asc')
            ->paginate(3);
    }
}
