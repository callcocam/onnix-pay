<?php
/**
 * Created by Claudio Campos.
 * User: callcoam
 * https://www.sigasmart.com.br
 */

namespace App\Core\Helpers\Countdown\Facades;

use Illuminate\Support\Facades\Facade;

class CountdownFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'callcocam.countdown';
    }
}