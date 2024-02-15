<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Services\Onixpay;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;

class AuthService extends OnnixPayService
{


    public function login($data = [])
    { 
        
        $response = Http::acceptJson()->baseUrl(config('onnixpay.base_uri', 'https://onnixpay.com/api/v1/'))
        ->withBasicAuth($this->getUsername(), $this->getPassword())
            ->post('auth', $data);  
        return $response->json();
    }
}
