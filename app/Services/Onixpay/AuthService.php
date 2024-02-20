<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Services\Onixpay;

use Illuminate\Support\Facades\Http;

trait AuthService
{


    public function login($data = [])
    {
        $response =  Http::acceptJson()
            ->contentType('application/json')
            ->baseUrl(config('onnixpay.api_url', 'https://onnixpay.com/api/'))
            ->withBasicAuth($this->getUsername(), $this->getPassword())
            ->post('auth', $data);

        if ($response->ok()) {
            $this->setBearer($response->json('token'));
        }

        return $response->json();
    }
}
