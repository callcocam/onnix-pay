<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Services;

abstract class OnnixPayService
{
    protected $http;

    public function __construct()
    {
        $this->http = new \GuzzleHttp\Client([
            'base_uri' => config('onnixpay.base_uri'),
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.config('onnixpay.token')
            ]
        ]);
    }
}