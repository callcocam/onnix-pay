<?php
/**
 * Created by Claudio Campos.
 * User: callcoam
 * https://www.sigasmart.com.br
 */

namespace App\Core\Helpers\Countdown\Exceptions;

use InvalidArgumentException;

class InvalidPropertyStringForHumanException extends InvalidArgumentException
{
    protected $message = 'String to parse for human contains invalid property';
}