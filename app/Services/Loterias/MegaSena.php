<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Services\Loterias;
 

class MegaSena extends LoteriasService
{
    protected $http;

    public static function make()
    {
        return new static();
    }

    public function get()
    {
        $response = $this->http->get('megasena');


        return $response->json();
    }
}
