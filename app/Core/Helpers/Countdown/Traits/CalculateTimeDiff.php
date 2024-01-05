<?php

/**
 * Created by Claudio Campos.
 * User: callcoam
 * https://www.sigasmart.com.br
 */

namespace App\Core\Helpers\Countdown\Exceptions;

use App\Core\Helpers\Countdown;
use Carbon\Carbon;

trait CalculateTimeDiff
{
    /**
     * Return elapsed time based in model attribite
     *
     * @param  string $attribute
     * @return Countdown $countdown
     */
    public function elapsed($attribute)
    {
        $countdown = app('callcocam.countdown');
        $attribute = $this->{$attribute};
        $now = Carbon::now();

        return $countdown->from($attribute)
            ->to($now)->get();
    }

    /**
     * Return until time based in model attribite
     *
     * @param  string $attribute
     * @return Countdown $countdown
     */
    public function until($attribute)
    {
        $countdown = app('callcocam.countdown');
        $attribute = $this->{$attribute};
        $now = Carbon::now();

        return $countdown->from($now)
            ->to($attribute)->get();
    }
}
