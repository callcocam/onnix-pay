<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Services\Onixpay;

class Invoice extends OnnixPayService
{

    public function get($id)
    {
        $response = $this->http->get("invoice/$id");
        return json_decode($response->getBody()->getContents());
    }

    public function ref($ref)
    {
        $response = $this->http->get("invoice/ref/$ref");
        return json_decode($response->getBody()->getContents());
    }

    public function all($limit = 100, $page = 1)
    {
        $response = $this->http->get("invoices?limit=$limit&page=$page");
        return json_decode($response->getBody()->getContents());
    }
}
