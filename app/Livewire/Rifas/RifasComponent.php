<?php

namespace App\Livewire\Rifas;

use App\Models\Rifas\Category;
use App\Models\Rifas\Rifa;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

class RifasComponent extends Component
{

    #[Url]
    public $c;

    public function render()
    {
        return view('livewire.rifas.rifas-component');
    }

    #[Computed]
    public function  rifas()
    {
        return Rifa::query()
            ->where('status', 'published')
            ->whereDate('start_date', '<=', now())
            ->when($this->c, function ($query) {
                $query->whereHas('category', function ($query) {
                    $query->where('slug', $this->c);
                });
            })
            ->orderBy('ordering', 'asc')
        ->paginate(12);
    }
    #[Computed]
    public function category()
    {
        return Category::query()->whereNull('category_id')->first();
    }

    public function loadCategory($slug)
    {
        $this->c = $slug;
    }
}
