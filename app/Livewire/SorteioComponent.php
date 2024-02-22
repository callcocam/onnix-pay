<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Livewire;

use App\Models\Rifas\Rifa;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SorteioComponent extends Component
{

    public $sorteio;

    public $rifa;

    public function mount(Rifa $rifa)
    {
        $this->rifa = $rifa;

        $this->sorteio = $rifa->contest;
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
    public function render()
    {
        if ($this->sorteio) {
            if ($this->sorteio->description) {
                return view('livewire.sorteio-winnwer-component');
            }
        }
        return view('livewire.sorteio-component');
    }
}
