<?php

use App\Livewire\Checkout\CancelComponent;
use App\Livewire\Checkout\SuccessComponent;
use App\Livewire\SorteioComponent;
use App\Models\Order;
use App\Models\Rifas\Sales\Sale;
use App\Services\Loterias\MegaSena;
use App\Services\Onixpay\AuthService;
use App\Services\Onixpay\Invoice;
use App\Services\Onixpay\Pix;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/inicio', \App\Livewire\Dashboard::class)->name('home');
Route::get('/', \App\Livewire\Dashboard::class)->name('dashboard');
Route::get('/todas-as-rifas', \App\Livewire\Rifas\ListComponent::class)->name('rifas.list');
Route::middleware('auth')->get('/rifas/{record}', \App\Livewire\Rifas\ShowComponent::class)->name('rifas.show');
Route::get('/sobre-nos', \App\Livewire\AboutComponent::class)->name('about');
Route::get('/contato', \App\Livewire\ContactComponent::class)->name('contact');
Route::get('/termos-de-uso', \App\Livewire\TermsComponent::class)->name('terms');
Route::get('/politica-de-privacidade', \App\Livewire\PrivacyComponent::class)->name('privacy');
Route::middleware('auth')->get('/finalizar-compra', \App\Livewire\Checkouts\CheckoutComponent::class)->name('checkout');

Route::middleware('auth')->get('/minha-conta', \App\Livewire\Profile\ShowComponent::class)->name('profile.show');

Route::get('/onixpay/callback', \App\Http\Controllers\OnixpayCallbackController::class)->name('onixpay.callback');


Route::middleware('guest')->group(function () {
    Route::get('login', \App\Livewire\Auth\Login::class)
        ->name('login');

    Route::get('register', \App\Livewire\Auth\Register::class)
        ->name('register');
});

Route::get('password/reset', \App\Livewire\Auth\Passwords\Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', \App\Livewire\Auth\Passwords\Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', \App\Livewire\Auth\Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', \App\Livewire\Auth\Passwords\Confirm::class)
        ->name('password.confirm');

    Route::get('pedidos', \App\Livewire\OrdersComponent::class)
        ->name('orders.list');

    Route::get('pedidos/{sale}', \App\Livewire\OrderComponent::class)
        ->name('orders.show');

    Route::get('rifas/{sale}/comprar', \App\Livewire\Checkout::class)->name('sales.buy');

    Route::get('email/verify/{id}/{hash}', \App\Http\Controllers\Auth\EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', \App\Http\Controllers\Auth\LogoutController::class)
        ->name('logout');
});
Route::get('/billing-portal', function (Request $request) {
    return view('update-payment-method', [
        'intent' => $request->user()->createSetupIntent()
    ]);
});


// Route::get('/pix', function () {
//     $res = Pix::make()->create([
//         "amount" => 1,
//         "email" => "evelynliviarodrigues@alkbrasil.com.br",
//         "quantity" => 1,
//         "discount" => 0,
//         "invoice_no" => "2",
//         "due_date" => "2023-11-09",
//         "tax" => 0,
//         "item_name" => "Teste de invoice",
//         "notes" => "Teste de observacoes de invoice",
//         "document" => "12345678909",
//         "client" => "Evelyn Lívia Rodrigues"
//     ]);
//     return response()->json($res);
// });


Route::get('checkout/{sale}/success',  SuccessComponent::class)->name('checkout-success');
Route::get('checkout/{sale}/cancel',  CancelComponent::class)->name('checkout-cancel');

Route::get('checkout', function (Request $request) {
    return $request->user()->checkout(['price_tshirt' => 1], [
        'success_url' => route('checkout-success') . '?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => route('checkout-cancel'),
    ]);
})->name('checkout-create');


Route::get('sorteio/{rifa}',  SorteioComponent::class)->name('sorteio');

Route::get('megasena', function (Request $request) {

    return MegaSena::make()->get($request->query('concurso'));
});

Route::get('invoice', function (Request $request) {
    $results = [];
    $sales = Sale::query()->whereIn('status', [ 'pending', 'processing'])->get(); 
 
    if ($sales->count() > 0) {
        foreach ($sales as $sale) {
            $invoce = json_decode($sale->data, true); 
            if ($invoice = data_get($invoce, 'invoice')) {
                $data = Invoice::make()->ref(data_get($invoice, 'reference'));
                if ($data) {
                    $results[] = $data;
                    $sale->status = strtolower(data_get($data, 'invoice.status', 'pending'));
                    $sale->save();
                    $sale->numbers->each(function ($number) use ($data) {
                        $number->status = strtolower(data_get($data, 'invoice.status', 'pending'));
                        $number->save();
                    });
                }
            }
        }
    }
    return response()->json($results);
});



Route::get('order/payment',  function (Request $request) {

    return view('checkout.mp');
})->name('order.payment');

Route::post('process_payment',  function (Request $request) {
    try {

        MercadoPagoConfig::setAccessToken("TEST-2193067924176798-031221-c55a88de49c5362df5f7f17721f9cfd2-141738866");

        $client = new PaymentClient();
        $request_options = new RequestOptions();
        $id = uniqid();
        $request_options->setCustomHeaders(["X-Idempotency-Key: {$id}"]);
        $data = $request->input(); 
        $payment = $client->create([
            "transaction_amount" => (float) data_get($data, 'transaction_amount'),
            "token" => data_get($data, 'token'),
            "description" => data_get($data, 'description'),
            "installments" =>  (int)data_get($data, 'installments'),
            "payment_method_id" => data_get($data, 'payment_method_id'),
            "issuer_id" => data_get($data, 'issuer_id'),
            "payer" => [
                "email" => data_get($data, 'payer.email'),
                "identification" => [
                    "type" => data_get($data, 'payer.identification.type'),
                    "number" => data_get($data, 'payer.identification.number')
                ]
            ]
        ], $request_options);
        dd($payment);
        return $payment;
    } catch (MPApiException $e) {
        return $e ;
    }
})->name('order.process_payment');