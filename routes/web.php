<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/pay/{gateway}', 'PaymentController@payWithGateway');

Route::get('/payment/form', [PaymentController::class, 'showPaymentForm'])->name('show.payment.form');
Route::get('/payment/callback', 'PaymentController@paymentCallback')->name('payment.callback');

Route::post('/payment/process/{gateway}', [PaymentController::class, 'processPayment'])->name('process.payment');

Route::get('/payment/paystack', [PaymentController::class, 'showPaystackForm'])->name('show.paystack.form');
Route::post('/paystack/callback', [PaymentController::class, 'paymentCallback'])->name('paystack.callback');
