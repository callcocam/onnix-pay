<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Services\Onixpay;

class Bill extends OnnixPayService
{
    public function create($data)
    {
        $response = $this->http->post('boleto/create',  $data);
        return $response;
    }

    public function get($id)
    {
        $response = $this->http->get("boleto/invoice/$id");
        return json_decode($response->getBody()->getContents());
    }
}
