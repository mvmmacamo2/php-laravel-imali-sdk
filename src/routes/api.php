<?php

use \Miguelmacamo\Payment\Http\Controllers\TransactionController;


Route::prefix('api')->group(function () {

    Route::get('get-payments/{accountNumber}', [TransactionController::class, 'getPayments']);
    Route::get('get-generated-payments/{accountNumber}', [TransactionController::class, 'getGeneratedPayments']);
    Route::get('get-qrcode/{accountNumber}', [TransactionController::class, 'getQrcode']);
    Route::get('get-payments-refund/{accountNumber}', [TransactionController::class, 'getRefundPayments']);

    Route::get('get-payments-refund/{accountNumber}', [TransactionController::class, 'getRefundPayments']);


    Route::post('request-payment', [TransactionController::class, 'requestPayment']);
    Route::post('confirm-payment', [TransactionController::class, 'confirmPayment']);


    Route::post('request-payment-refund', [TransactionController::class, 'requestRefund']);
    Route::post('confirm-payment-refund', [TransactionController::class, 'refundConfirmation']);

    Route::post('generate-transaction', [TransactionController::class, 'generateTransaction']);


//    Route::controller(TransactionController::class)->group(function () {
//
//        Route::get('get-payments/{accountNumber}', 'getPayments');
//        Route::get('get-generated-payments/{accountNumber}', 'getGeneratedPayments');
//        Route::get('get-qrcode/{accountNumber}', 'getQrcode');
//        Route::get('get-payments-refund/{accountNumber}', 'getRefundPayments');
//
//        Route::get('get-payments-refund/{accountNumber}',  'getRefundPayments');
//
//        Route::post('request-payment', 'requestPayment');
//        Route::post('confirm-payment', 'confirmPayment');
//    });

});
