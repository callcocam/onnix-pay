<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// Route::get('/rifas/{rifa}/comprar', \App\Http\Livewire\Rifas\BuyComponent::class)->name('rifas.buy'); 
Route::get('/sobre-nos', \App\Livewire\AboutComponent::class)->name('about');
Route::get('/contato', \App\Livewire\ContactComponent::class)->name('contact');
Route::get('/termos-de-uso', \App\Livewire\TermsComponent::class)->name('terms');
Route::get('/politica-de-privacidade', \App\Livewire\PrivacyComponent::class)->name('privacy');
Route::get('/new', \App\Livewire\NewPage::class)->name('new');
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
});

Route::middleware('auth')->group(function () {
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