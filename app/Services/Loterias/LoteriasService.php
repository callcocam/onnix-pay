<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Services\Loterias;

use Illuminate\Support\Facades\Http;

abstract class LoteriasService
{
    const URL = 'https://servicebus2.caixa.gov.br/portaldeloterias/api/';

    protected $http;

    public function __construct()
    {
        $this->http = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->baseUrl(self::URL);
    }
}