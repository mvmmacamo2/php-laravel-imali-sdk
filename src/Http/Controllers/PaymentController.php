<?php

namespace Miguelmacamo\Payment\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use DB;

class PaymentController extends Controller
{
    protected $client;
    protected $baseURL;
    protected $apiKey;
    protected $request;
    protected $production;


    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->production = config('imali.production');

        if (!$this->production) {
            $this->baseURL = "https://paytek-africa.com/imalipartinersapi/public/api/partner/";
        } else {
            $this->baseURL = "https://paytek-africa.com/imaliapipartnersprod/public/api/partner/";
        }


        $this->apiKey = config('imali.apiKey');

    }

    public function index()
    {
        return view('imali::home');
    }

    public function payments()
    {
        return view('imali::payments');
    }

    public function requestPayment(Request $request)
    {

//        return $request->all();


        $fields = array('amount' => $request->amount, 'clientAccountNumber' => $request->clientAccountNumber, 'storeAccountNumber' => $request->storeAccountNumber,
            'description' => 'Computador Hp 3500', 'transactionID' => Uuid::uuid4(), 'terminalChannel' => 'Web', 'terminalCompanyName' => 'KayaEventos', 'terminalID' => '201');
//        $headers = array('Authorization: ' . config('imali.apiKey'), 'Accept: application/json');
        $headers = array('Authorization: ' . $this->apiKey, 'Accept: application/json');
//        $url = 'https://paytek-africa.com/imalipartinersapi/public/api/partner/generate-payment';
        $makePaymentUrl = 'generate-payment';


        $valuesToAdd = ['transactionID' => Uuid::uuid4()];

        $request->merge($valuesToAdd);


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseURL . $makePaymentUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $request->all());
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        DB::transaction(function () {
        }, 5);

//        return json_decode($result, true);
        return response()->json(json_decode($result, true), $httpcode);

//        return response()->json(['data' => $request->all(), 'config' => config('imali.production'), 'statusCURL' => $httpcode]);
    }

    public function makePayment(Request $request)
    {

        $this->validate($request, [
            'token' => 'required|min:6',
            'partner_transaction_id' => 'required',
        ], [
            'token.required' => 'token Obrigatório',
            'partner_transaction_id.required' => 'Partner transaction Obrigatório',
        ]);

        $headers = array('Authorization: ' . $this->apiKey, 'Accept: application/json');

        $makePaymentUrl = 'confirm-imali';

//        $valuesToAdd = ['transactionID' => Uuid::uuid4()];

//        $request->merge($valuesToAdd);


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseURL . $makePaymentUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $request->all());
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        DB::transaction(function () {
        }, 5);


        return response()->json(json_decode($result, true), $httpcode);

    }

    public function refundCustomer(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
            'description' => 'required',
            'customerAccountNumber' => 'required',
            'storeAccountNumber' => 'required',
            'paymentTransaction' => 'required',
            'partnerTransactionID' => 'required',
            'terminalID' => 'required',
            'terminalChannel' => 'required',
            'terminalCompanyName' => 'required',
        ], [
            'amount.required' => 'O Campo transaction é de carácter Obrigatório',
            'description.required' => 'O campo description é obrigatório',
            'partner_transaction_id.required' => 'O campo partner_transaction_id é obrigatório',
            'account_number.required' => 'O campo account_number é obrigatório',
            'merchant_id.required' => 'O campo merchant_id é obrigatório',
            'payment_transaction.required' => 'O campo payment_transaction é obrigatório',
            'store_account_number.required' => 'O campo store_account_number é obrigatório',
            'user_client_id.required' => 'O campo imali_user_id é obrigatório',
        ]);

        $headers = array('Authorization: ' . $this->apiKey, 'Accept: application/json');

        $makePaymentUrl = 'refund-imali';

        $valuesToAdd = ['partnerTransactionID' => Uuid::uuid4()];

        $request->merge($valuesToAdd);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseURL . $makePaymentUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $request->all());
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        DB::transaction(function () {
        }, 5);


        return response()->json(json_decode($result, true), $httpcode);
    }

    public function refundCustomerConfirmation(Request $request)
    {

        $this->validate($request, [
            'partner_transaction_id' => 'required',
            'token_otp' => 'required'
        ]);

        $headers = array('Authorization: ' . $this->apiKey, 'Accept: application/json');
//
        $makePaymentUrl = 'refund-confirmation';
//
//        $valuesToAdd = ['partnerTransactionID' => Uuid::uuid4()];

//        $request->merge($valuesToAdd);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseURL . $makePaymentUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $request->all());
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        DB::transaction(function () {
        }, 5);

        return response()->json(json_decode($result, true), $httpcode);

    }

    public function generatePayment(Request $request)
    {

        $this->validate($request, [
            'amount' => 'required',
            'accountNumber' => 'required',
            'transactionID' => 'required|min:12',
            'terminalID' => 'required',
            'terminalChannel' => 'required',
            'terminalCompanyName' => 'required'
        ], [
            'accountNumber.required' => 'O Campo accountNumber é Obrigatório',
            'transactionID.required' => 'O Campo transactionID é Obrigatório',
            'amount.required' => 'O Campo amount é Obrigatório',
            'terminalCompanyName.required' => 'O campo terminalCompanyName é Obrigatório',
            'terminalID.required' => 'terminalID é Obrigatório',
            'terminalChannel.required' => 'terminalChannel é Obrigatório',
        ]);

        $headers = array('Authorization: ' . $this->apiKey, 'Accept: application/json');
//
        $makePaymentUrl = 'generate-transaction';
//
//        $valuesToAdd = ['partnerTransactionID' => Uuid::uuid4()];

//        $request->merge($valuesToAdd);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseURL . $makePaymentUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $request->all());
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        DB::transaction(function () {
        }, 5);

        return response()->json(json_decode($result, true), $httpcode);

    }

    public function getStorePayments($storeAccountNumber)
    {

        $headers = array('Authorization: ' . $this->apiKey, 'Accept: application/json');
//
        $makePaymentUrl = 'get-store-payments/' . $storeAccountNumber;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseURL . $makePaymentUrl);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($fields));
//        curl_setopt($curl, CURLOPT_POSTFIELDS, $request->all());
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return response()->json(json_decode($result, true), $httpcode);

    }

    public function getGeneratedPayments($storeAccountNumber)
    {
        $headers = array('Authorization: ' . $this->apiKey, 'Accept: application/json');

        $makePaymentUrl = 'get-generated-payments/' . $storeAccountNumber;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseURL . $makePaymentUrl);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return response()->json(json_decode($result, true), $httpcode);

    }

    public function getStorePaymentsRefunds($storeAccountNumber)
    {
        $headers = array('Authorization: ' . $this->apiKey, 'Accept: application/json');

        $makePaymentUrl = 'get-store-payments-refunds/' . $storeAccountNumber;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseURL . $makePaymentUrl);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return response()->json(json_decode($result, true), $httpcode);

    }

    public function getQRCODE($storeAccountNumber)
    {
        $headers = array('Authorization: ' . $this->apiKey, 'Accept: application/json');

        $makePaymentUrl = 'get-qrcode/' . $storeAccountNumber;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseURL . $makePaymentUrl);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return response()->json(json_decode($result, true), $httpcode);

    }
}
