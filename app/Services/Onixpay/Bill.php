<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Services\Onixpay;

class Bill extends OnnixPayService
{
    public function create($order,  $data = [])
    {

        $dataPost  = array_merge([
            "amount" =>  $order->total,
            "quantity" => $order->quantity,
            "discount" => $order->discount,
            "invoice_no" => $order->invoice,
            "due_date" => $order->created_at->addDays(3)->format('Y-m-d'),
            "item_name" => get_tenant()->name . " - " . $order->id,
            "customer" => auth()->user()->customer,
            "notes" => "Pedido de compra",
            "instructions" => "Não receber após o vencimento",
        ], $data);
 
        $response = $this->http->post('boleto/create',  $dataPost);

        dd($response->getBody()->getContents());
        return $response;
    }

    public function get($id)
    {
        $response = $this->http->get("boleto/invoice/$id");
        return json_decode($response->getBody()->getContents());
    }
}
