<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Services\Onixpay;

class Customer extends OnnixPayService
{
    public function create($user, $data = [])
    {
        $data = array_merge(
            $data,
            [
                "name" => $user->name,
                "email" => $user->email,
                "document" => $user->document,
                "document_type" => strlen($user->document) >= 14 ? "CNPJ" : "CPF",
                "phone" => $user->phone,
                "mobilephone" => $user->phone,
                "country_id" => 30,
                "zipcode" => $user->address->zip,
                "state" => $user->address->state,
                "city" => $user->address->city,
                "district" => $user->address->district,
                "street" => $user->address->street,
                "number" => $user->address->number,
            ]
        );
        $response = $this->http->post('customer',   $data);
        return  $response;
    }

    public function exists($id)
    {
        $response = $this->get($id);
        if ($response->ok()) {
            return true;
        }
        return false;
    }

    public function get($id)
    {
        $response = $this->http->get("customer/$id");
        return $response;
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
