<?php
/**
 * Created by Claudio Campos.
 * User: callcoam
 * https://www.sigasmart.com.br
 */
namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

class CountDown extends Component
{

    public $date;

    public $time;

    public $year;

    public $month;

    public $weeks;

    public $day;

    public $hour;

    public $minute;

    public $second;

    public function mount($date )
    {
        $this->date = $date;
        $this->time = "00:00:00"; 
    }

    #[Computed]
    public function diffDays()
    {
        $now = now();
        $date = Carbon::create($this->date);
        $year = $date->year;
        $month = $date->month;
        $day = $date->day;
        $time = Carbon::create($this->time);
        $hour = $time->hour;
        $minute = $time->minute;
        $second = $time->second;
        $date = Carbon::create($year, $month, $day, $hour, $minute, $second);
        $countdown = \App\Core\Helpers\Countdown\Facades\CountdownFacade::from($now)
            ->to($date)->get();

        $this->year = $countdown->years; 
        $this->weeks = $countdown->weeks;
        $this->day = $countdown->days;
        $this->hour = $countdown->hours;
        $this->minute = $countdown->minutes;
        $this->second = $countdown->seconds;

        return [
            'years' => $this->year,
            'month' => $this->month,
            'weeks' => $this->weeks,
            'days' => $this->day,
            'hours' => $this->hour,
            'minutes' => $this->minute,
            'seconds' => $this->second,
        ];

    }


    public function render()
    {
        return view('livewire.count-down');
    }
}
