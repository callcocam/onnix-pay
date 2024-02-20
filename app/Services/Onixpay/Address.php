<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Services\Onixpay;

class Address extends OnnixPayService
{
    public function create($data)
    {
        $response = $this->http->post('address',   $data );
        return  $response;
    }

    public function get($id)
    {
        $response = $this->http->get("address/$id");
        return  $response;
    }

    public function all()
    {
        $response = $this->http->get("addresses");
        return  $response;
    }

    public function couuntries()
    {
        $response = $this->http->get("country/all");
        return  $response;
    }

    public function states()
    {
        $response = $this->http->get("state/all");
        return  $response;
    }
}