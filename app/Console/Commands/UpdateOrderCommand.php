<?php

namespace App\Console\Commands;

use App\Models\Rifas\Sales\Sale;
use App\Services\Onixpay\Invoice;
use Illuminate\Console\Command;
use App\Services\Mp\MercadoPagoConfig as MpMercadoPagoConfig;

class UpdateOrderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualizar status do pedido';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $sales = Sale::query()->whereIn('status', ['draft', 'pending', 'processing'])->get();
        // if ($sales->count() > 0) {
        //     foreach ($sales as $sale) {
        //         $invoce = json_decode($sale->data, true);
        //         if ($invoice = data_get($invoce, 'invoice')) {
        //             $data = Invoice::make()->ref(data_get($invoice, 'reference'));
        //             if ($data) {
        //                 $results[] = $data;
        //                 $sale->status = strtolower(data_get($data, 'invoice.status', 'pending'));
        //                 $sale->save();
        //                 $sale->numbers->each(function ($number) use ($data) {
        //                     $number->status = strtolower(data_get($data, 'invoice.status', 'pending'));
        //                     $number->save();
        //                 });
        //             }
        //         }
        //     }
        // }

        $sales = Sale::query()->whereIn('status', ['draft', 'pending', 'processing'])->get();
        if ($sales->count() > 0) {
            foreach ($sales as $sale) {
                $dataIvoice = json_decode($sale->data, true); 
                if ($id = data_get($dataIvoice, 'id')) { 
                    $http = MpMercadoPagoConfig::make()->setAccessToken(config('services.mercadopago.token'))
                        ->getHttpClient()->get('/v1/payments/' . $id);
                    if ($http->ok()) {
                        $status = $http->json('status'); 
                        if($status != $sale->status){
                            $sale->status = strtolower($status);
                            $sale->save();
                            $sale->numbers->each(function ($number) use ($status) {
                                $number->status = strtolower($status);
                                $number->save();
                            });
                        } 
                    }  
                }
            }
        }
    }
}
