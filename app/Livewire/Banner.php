<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class Banner extends Component
{
    public function render()
    {
        return view('livewire.banner');
    }

    #[Computed]
    public function banner()
    {
        return \App\Models\Banner::query()->where('status', 'published')
            ->whereDate('start_date', '<=', now())
            ->orderBy('ordering', 'asc')
            ->first();
    }

    public function click()
    {
        if ($this->banner) { 
            $this->banner->addClick();

            if ($this->banner->link) {
                return redirect()->away($this->banner->link);
            }
        }
    }
}
