<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Services\Onixpay;

class Creditcard extends OnnixPayService
{
    public function create($order, $data = [])
    {

        $postData = array_merge([
            "amount" => 100.59,
            "installments" => 6,
            "email" => "evelynliviarodrigues@alkbrasil.com.br",
            "quantity" => 1,
            "discount" => 0,
            "invoice_no" => "3",
            "due_date" => $order->created_at->format('Y-m-d'),
            "item_name" => "Teste de invoice",
            "tax" => 0,
            "creditcard_holder" => "Evelyn Livia Rodrigues",
            "creditcard_number" => "5579066342540490",
            "creditcard_cvv" => "448",
            "creditcard_month" => "01",
            "creditcard_year" => "2023",
            "creditcard_brand" => "Visa",
            "notes" => "um anotação qualquer"
        ], $data);
 
        $response = $this->http->post('creditcard/create',    $postData);
 
        return $response;
    }

    public function get($id)
    {
        $response = $this->http->get("creditcard/invoice/$id");
        return json_decode($response->getBody()->getContents());
    }
}
