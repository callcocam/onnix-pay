<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Livewire;

use App\Models\Rifas\Sales\Sale;
use App\Models\User;
use App\Models\Winner;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class TopWinnerComponent extends Component
{

    public $sale;

    public $rifa;

    public $topWinner;

    public $user;

    public $winner;

    public $contest;

    public function mount()
    { 

        $this->topWinner = $this->topWinner();
    }

    public function render()
    {
        return view('livewire.top-winner-component');
    }
 
    public function topWinner()
    {
        $data = DB::table('winners')
            ->select('user_id', DB::raw('COUNT(*) as count'))
            ->groupBy('user_id')
            ->orderBy('count', 'desc')
            ->first();

        if (!$data) {
            return null;
        }

        $this->winner = Winner::where('user_id', $data->user_id)
            ->orderBy('created_at', 'desc')
            ->first();

        $this->sale =  $this->winner->sale;

        if (!$this->sale) {
            return null;
        }

        $this->rifa = $this->sale->rifa; 
 
        $this->user = User::find($data->user_id);
 

        $this->contest = $this->rifa->contest; 

        return $this->user;
    }
}
