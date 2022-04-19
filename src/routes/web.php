<?php

use Illuminate\Http\Request;

use \Miguelmacamo\Payment\Http\Controllers\PaymentController;

Route::prefix('imali')->group(function () {

    Route::get('home', [PaymentController::class, 'index']);
    Route::get('payments', [PaymentController::class, 'payments']);

    Route::post('request-payment', [PaymentController::class, 'requestPayment'])->name('requestPayment');
});

Route::get('get-payments/{accountNumber}', [PaymentController::class, 'getStorePayments'])->name('getPayments');
Route::get('get-generated-transactions/{accountNumber}', [PaymentController::class, 'getGeneratedPayments'])->name('getGeneratedPayments');
Route::get('get-store-payments-refunds/{accountNumber}', [PaymentController::class, 'getStorePaymentsRefunds'])->name('getStorePaymentsRefunds');
Route::get('get-qrcode/{accountNumber}', [PaymentController::class, 'getQRCODE'])->name('getQrcode');


Route::post('request-payment', [PaymentController::class, 'requestPayment']);
