<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Services\Onixpay;

class Pix extends OnnixPayService
{
    public function create($order, $data = [])
    {

        $postData = array_merge([
            "amount" =>  $order->total,
            "email" => data_get($data, 'pix_email', auth()->user()->email),
            "quantity" => $order->quantity,
            "discount" => $order->discount,
            "invoice_no" => $order->invoice,
            "due_date" => $order->created_at->addDays(3)->format('Y-m-d'),
            "tax" => $order->shipping,
            "notes" => $order->description,
            "document" => data_get($data, 'document', auth()->user()->document),
            "client" => auth()->user()->name
        ], $data); 

        $response = $this->http->post('pix/create', $postData);  
        return $response;
    }

    public function get($id)
    {
        $response = $this->http->get("pix/invoice/$id");
        return json_decode($response->getBody()->getContents());
    }
}
