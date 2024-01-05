<?php
/**
 * Created by Claudio Campos.
 * User: callcoam
 * https://www.sigasmart.com.br
 */

namespace App\Core\Helpers\Countdown\Exceptions;

use InvalidArgumentException;

class InvalidArgumentToCountdown extends InvalidArgumentException
{
    protected $message = 'You must at least tell where to count from.';
}