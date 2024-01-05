<?php
/**
 * Created by Claudio Campos.
 * User: callcoam
 * https://www.sigasmart.com.br
 */

namespace App\Core\Helpers\Countdown\Exceptions;

use InvalidArgumentException;

class InvalidDateFormatToCountdown extends InvalidArgumentException
{
    protected $message = 'Invalid date string or object to parse.';
}