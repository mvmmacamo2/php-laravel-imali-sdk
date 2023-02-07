<?php

namespace Miguelmacamo\Payment\Http\Module;

namespace Miguelmacamo\Payment\Http\Module;
use DB;

class IMaliTransaction
{

    protected $client;
    protected $baseURL;
    protected $apiKey;
    protected $request;
    protected $result;

    private $storeAccountNumber;
    private $customerAccountNumber;
    private $description;
    private $amount;
    private $terminalID;
    private $transactionID;
    private $terminalCompanyName;
    private $terminalChannel;
    private $partnerTransactionID;
    private $paymentTransaction;
    private $production;
    private $localization;
    private $headers;
    private $database;


    public function __construct()
    {
        $this->apiKey = config('imali.apiKey');
        $this->production = config('imali.production');
        $this->localization = config('imali.localization');
        $this->database = config('imali.database');

        $this->headers = array(
            'Authorization: ' . $this->apiKey,
            'Accept: application/json',
            'X-localization: ' . strtolower($this->localization)
        );

        if (!$this->production) {
            $this->baseURL = "https://paytek-africa.com/imalipartnersapi/public/api/partner/";
        } else {
            $this->baseURL = "https://paytek-africa.com/imalipartnersprod/public/api/partner/";
        }
    }
    public function checkTransaction(string $transaction): \Illuminate\Http\JsonResponse
    {
        $makePaymentUrl = 'check-transaction/' . $transaction;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseURL . $makePaymentUrl);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return response()->json(json_decode($result, true), $httpcode);
    }

    public function generatePayment(string $transactionID,
                                    int    $storeAccountNumber,
                                    int    $customerAccountNumber,
                                    float  $amount,
                                    string $description,
                                    string $terminalChannel,
                                    string $terminalCompanyName,
                                    string $terminalID): \Illuminate\Http\JsonResponse
    {
        $this->description = $description;
        $this->storeAccountNumber = $storeAccountNumber;
        $this->customerAccountNumber = $customerAccountNumber;
        $this->amount = $amount;
        $this->terminalID = $terminalID;
        $this->transactionID = $transactionID;
        $this->terminalChannel = $terminalChannel;
        $this->terminalCompanyName = $terminalCompanyName;

        $makePaymentUrl = 'generate-payment';

        $data = [
            'amount' => $amount,
            'clientAccountNumber' => $customerAccountNumber,
            'storeAccountNumber' => $storeAccountNumber,
            'description' => $description,
            'transactionID' => $transactionID,
            'terminalChannel' => $terminalChannel,
            'terminalCompanyName' => $terminalCompanyName,
            'terminalID' => $terminalID
        ];


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseURL . $makePaymentUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if (($httpcode == 200 || $httpcode == 201) && $this->database) {

            DB::transaction(function () {

                DB::table('imali_payments')->insert([
                    'store_account_number' => $this->storeAccountNumber,
                    'customer_account_number' => $this->customerAccountNumber,
                    'amount' => $this->amount,
                    'description' => $this->description,
                    'transaction_id' => $this->transactionID,
                    'terminalCompanyName' => $this->terminalCompanyName,
                    'terminalChannel' => $this->terminalChannel,
                    'terminalID' => $this->terminalID,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

            }, 2);
        }

        return response()->json(json_decode($result, true), $httpcode);
    }

    public function confirmPayment($partnerTransactionID, $token)
    {
        $this->token = $token;

        $this->partnerTransactionID = $partnerTransactionID;

        $makePaymentUrl = 'confirm-payment';

        $valuesToAdd = ['partner_transaction_id' => $partnerTransactionID, 'token' => $token];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseURL . $makePaymentUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $valuesToAdd);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if (($httpcode == 200 || $httpcode == 201) && $this->database) {

            DB::transaction(function () {
                DB::table('imali_payments')
                    ->where('transaction_id', $this->partnerTransactionID)
                    ->update(['status' => 'success']);

            }, 5);
        }
        return response()->json(json_decode($result, true), $httpcode);

    }

    public function requestRefundCustomer(string $partnerTransactionID,
                                          string $paymentTransaction,
                                          int    $customerAccountNumber,
                                          int    $storeAccountNumber,
                                          float  $amount,
                                          string $description,
                                          string $terminalID,
                                          string $terminalChannel,
                                          string $terminalCompanyName): \Illuminate\Http\JsonResponse
    {

        $this->amount = $amount;
        $this->partnerTransactionID = $partnerTransactionID;
        $this->paymentTransaction = $paymentTransaction;
        $this->description = $description;
        $this->terminalCompanyName = $terminalCompanyName;
        $this->terminalChannel = $terminalChannel;
        $this->terminalID = $terminalID;
        $this->customerAccountNumber = $customerAccountNumber;
        $this->storeAccountNumber = $storeAccountNumber;

        $makePaymentUrl = 'refund-customer';

        $data = [
            'amount' => $amount,
            'description' => $description,
            'customerAccountNumber' => $customerAccountNumber,
            'storeAccountNumber' => $storeAccountNumber,
            'paymentTransaction' => $paymentTransaction,
            'partnerTransactionID' => $partnerTransactionID,
            'terminalID' => $terminalID,
            'terminalChannel' => $terminalChannel,
            'terminalCompanyName' => $terminalCompanyName,
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseURL . $makePaymentUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if (($httpcode == 200 || $httpcode == 201) && $this->database) {
            DB::transaction(function () {
                DB::table('imali_refunds')->insert([
                    'store_account_number' => $this->storeAccountNumber,
                    'customer_account_number' => $this->customerAccountNumber,
                    'amount' => $this->amount,
                    'description' => $this->description,
                    'payment_transaction' => $this->paymentTransaction,
                    'partner_transaction_id' => $this->partnerTransactionID,
                    'terminalCompanyName' => $this->terminalCompanyName,
                    'terminalChannel' => $this->terminalChannel,
                    'terminalID' => $this->terminalID,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }, 5);
        }
        return response()->json(json_decode($result, true), $httpcode);
    }

    public function refundCustomerConfirmation(string $partnerTransactionID, int $otp)
    {
        $this->partnerTransactionID = $partnerTransactionID;

        $makePaymentUrl = 'refund-confirmation';

        $data = ['partner_transaction_id' => $partnerTransactionID, 'token_otp' => $otp];


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseURL . $makePaymentUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if (($httpcode == 200 || $httpcode == 201) && $this->database) {
            DB::transaction(function () {

                DB::table('imali_refunds')
                    ->where('partner_transaction_id', $this->partnerTransactionID)
                    ->update(['status' => 'success', 'updated_at' => now()]);
            }, 2);
        }

        return response()->json(json_decode($result, true), $httpcode);

    }

    public function generateTransaction(string $transactionID,
                                        int    $storeAccountNumber,
                                        float  $amount,
                                        string $terminalID,
                                        string $terminalChannel,
                                        string $terminalCompanyName): \Illuminate\Http\JsonResponse
    {
        $this->storeAccountNumber = $storeAccountNumber;
        $this->transactionID = $transactionID;
        $this->amount = $amount;
        $this->terminalID = $terminalID;
        $this->terminalChannel = $terminalChannel;
        $this->terminalCompanyName = $terminalCompanyName;

        $makePaymentUrl = 'generate-transaction';

        $data = [
            'amount' => $amount,
            'accountNumber' => $storeAccountNumber,
            'transactionID' => $transactionID,
            'terminalID' => $terminalID,
            'terminalChannel' => $terminalChannel,
            'terminalCompanyName' => $terminalCompanyName
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseURL . $makePaymentUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $this->result = $result;

        if (($httpcode == 200 || $httpcode == 201) && $this->database) {
            DB::transaction(function () {
                DB::table()->insert([
                    'transaction' => $this->result->transaction,
                    'amount' => $this->result->amount,
                    'account_number' => $this->result->account_number,
                    'address_store' => $this->result->address_store,
                    'institution' => $this->result->institution,
                    'promo' => $this->result->promo,
                ]);
            }, 2);
        }
        return response()->json(json_decode($result, true), $httpcode);
    }

    public function getQRCODE($storeAccountNumber): \Illuminate\Http\JsonResponse
    {
        $makePaymentUrl = 'get-qrcode/' . $storeAccountNumber;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseURL . $makePaymentUrl);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return response()->json(json_decode($result, true), $httpcode);
    }
}
