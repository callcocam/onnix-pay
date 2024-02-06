<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Services\Onixpay;

abstract class OnnixPayService
{
    protected $http;

    public function __construct()
    {

        $bearer = base64_encode(config('onnixpay.client_id').':'.config('onnixpay.client_secret'));

        $this->http = new \GuzzleHttp\Client([
            'base_uri' => config('onnixpay.base_uri'),
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$bearer
            ]
        ]);
    }
}