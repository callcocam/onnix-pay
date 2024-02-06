<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Services\Onixpay;

class Creditcard extends OnnixPayService
{
    public function create($data)
    {
        $response = $this->http->post('creditcard/create', [
            'json' => $data
        ]);
        return json_decode($response->getBody()->getContents());
    }

    public function get($id)
    {
        $response = $this->http->get("creditcard/invoice/$id");
        return json_decode($response->getBody()->getContents());
    }
}
