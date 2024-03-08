<?php

namespace App\Livewire\Rifas;

use App\Models\Rifas\Category;
use App\Models\Rifas\Rifa;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;;

class RifasComponent extends Component
{

    use WithPagination;

    #[Url]
    public $c;

    #[Url]
    public $category;

    public $limit = 12;

    public function mount($limit = 12)
    {
        $this->limit = $limit;
    }

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
            // ->whereDate('end_date', '>=', now()->addDays(10))
            ->when($this->category, function ($query) {
                $query->whereHas('category', function ($query) {
                    $query->where('slug', $this->category);
                });
            })
            ->when($this->c, function ($query) {
                $query->whereHas('category', function ($query) {
                    $query->where('slug', $this->c);
                });
            })
            ->orderBy('ordering', 'asc')
            ->paginate($this->limit);
    }

    #[Computed]
    public function catecorias()
    {
        return Category::query()
            ->whereHas('rifas', function ($query) {
                $query->where('status', 'published')
                    ->whereDate('start_date', '<=', now())->whereDate('end_date', '>=', now() );
            })
            ->orderBy('name', 'asc')
            ->get();
    }

    public function paginationView()
    {
        return 'includes.custom-pagination-links-view';
    }
}
