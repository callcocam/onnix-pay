<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Services\Onixpay;

class Customer extends OnnixPayService
{
    public function create($data)
    {
        $response = $this->http->post('customer', [
            'json' => $data
        ]);
        return json_decode($response->getBody()->getContents());
    }

    public function get($id)
    {
        $response = $this->http->get("customer/$id");
        return json_decode($response->getBody()->getContents());
    }

    public function all()
    {
        $response = $this->http->get("customers");
        return json_decode($response->getBody()->getContents());
    }

    public function couuntries()
    {
        $response = $this->http->get("country/all");
        return json_decode($response->getBody()->getContents());
    }
}
