<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Callcocam\Profile\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Callcocam\Profile\Profile
 */
class Profile extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Callcocam\Profile\Profile::class;
    }
}
