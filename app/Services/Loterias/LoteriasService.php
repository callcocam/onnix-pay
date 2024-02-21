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
    const URL = '//servicebus2.caixa.gov.br/portaldeloterias/api/';

    protected $http;

    public function __construct()
    {
        $this->http = Http::baseUrl(self::URL)->withOptions(["verify"=>false]);
    }
}