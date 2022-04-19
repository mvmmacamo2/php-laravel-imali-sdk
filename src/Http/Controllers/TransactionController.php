<?php

namespace Miguelmacamo\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Miguelmacamo\Payment\Http\Module\IMaliTransaction;

class TransactionController extends Controller
{
    protected $transaction;
    protected $request;

    public function __construct()
    {
        $this->transaction = new IMaliTransaction();
    }

    public function getPayments($accountNumber)
    {
        $result = $this->transaction->getPayments($accountNumber);

        return response()->json($result->original, $result->getStatusCode());
    }

    public function getGeneratedPayments($accountNumber)
    {
        $result = $this->transaction->getGeneratedPayments($accountNumber);
        return response()->json($result->original, $result->getStatusCode());
    }

    public function getQrcode($accountNumber)
    {
        $result = $this->transaction->getQRCODE($accountNumber);
        return response()->json($result->original, $result->getStatusCode());
    }

    public function getRefundPayments($accountNumber)
    {
        $result = $this->transaction->getRefundPayments($accountNumber);
        return response()->json($result->original, $result->getStatusCode());
    }

    public function requestPayment(Request $request)
    {
        $this->validate($request, [
            'transactionID' => 'required',
            'storeAccountNumber' => 'required',
            'customerAccountNumber' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'terminalChannel' => 'required',
            'terminalCompanyName' => 'required',
            'terminalID' => 'required'
        ]);
        $result = $this->transaction->requestPayment(
            $request->transactionID,
            $request->storeAccountNumber,
            $request->customerAccountNumber,
            $request->amount,
            $request->description,
            $request->terminalChannel,
            $request->terminalCompanyName,
            $request->terminalID
        );
        return response()->json($result->original, $result->getStatusCode());
    }

    public function confirmPayment(Request $request)
    {
        $this->request = $request;
        $this->validate($request, [
            'otp' => 'required',
            'transactionID' => 'required'
        ]);

        $result = $this->transaction->makePayment($this->request->transactionID, $this->request->otp);
        return response()->json($result->original, $result->getStatusCode());
    }

    public function requestRefund(Request $request)
    {
        $this->request = $request;

        $this->validate($request, [
            'amount' => 'required',
            'partnerTransactionID' => 'required',
            'paymentTransaction' => 'required',
            'description' => 'required',
            'terminalCompanyName' => 'required',
            'terminalChannel' => 'required',
            'terminalID' => 'required',
            'customerAccountNumber' => 'required',
            'storeAccountNumber' => 'required'

        ]);

        $result = $this->transaction->refundCustomer(
            $this->request->partnerTransactionID,
            $this->request->paymentTransaction,
            $this->request->customerAccountNumber,
            $this->request->storeAccountNumber,
            $this->request->amount,
            $this->request->description,
            $this->request->terminalID,
            $this->request->terminalChannel,
            $this->request->terminalCompanyName,
        );
        return response()->json($result->original, $result->getStatusCode());
    }

    public function refundConfirmation(Request $request)
    {
        $this->request = $request;

        $this->validate($request, [
            'partnerTransactionID' => 'required',
            'otp' => 'required',

        ]);

        $result = $this->transaction->refundCustomerConfirmation(
            $this->request->partnerTransactionID,
            $this->request->otp,
        );
        return response()->json($result->original, $result->getStatusCode());
    }

    public function generateTransaction(Request $request)
    {
        $this->request = $request;

        $this->validate($request, [
            'amount' => 'required',
            'transactionID' => 'required',
            'terminalCompanyName' => 'required',
            'terminalChannel' => 'required',
            'terminalID' => 'required',
            'storeAccountNumber' => 'required'

        ]);

        $result = $this->transaction->generatePayment(
            $this->request->transactionID,
            $this->request->storeAccountNumber,
            $this->request->amount,
            $this->request->terminalID,
            $this->request->terminalChannel,
            $this->request->terminalCompanyName,
        );
        return response()->json($result->original, $result->getStatusCode());
    }
}
