<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Services\Onixpay;

class AuthService extends OnnixPayService
{
     

    public function login($data)
    {
        $response = $this->http->post('login', [
            'json' => $data
        ]);
        return json_decode($response->getBody()->getContents());
    }
 
}