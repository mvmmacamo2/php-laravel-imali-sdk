# imaliSDK
This will allow partners to make payment to i.Mali

## Installation
``` bash
$ composer require miguelmacamo/imali
```

## Create Migrations
``` bash
$ php artisan migrate
```

### Publish configuration to config folder
php artisan vendor:publish

**Set your key on this file to make requests**
:file name is imali.php

```php
<?php
return [
    'production' => false,        
    'apiKey' => 'Bearer yourKey'
];
production 
false-> test server 
true to production server

apiKey should be diferent for test server to production server

```
## Usage: generate QRcode

```php

$transaction = new IMaliTransaction();

    $result = $transaction->generatePayment(
            $transactionID,
            $storeAccountNumber,
            $amount,
            $terminalID,
            $terminalChannel,
            $terminalCompanyName);
```

## Usage: request Payment

```php

$transaction = new IMaliTransaction();

   $result = $transaction->requestPayment(
            $transactionID,
            $storeAccountNumber,
            $customerAccountNumber,
            $amount,
            $description,
            $terminalChannel,
            $terminalCompanyName,
            $terminalID
        );
```

## Usage: confirm request Payment

```php

$transaction = new IMaliTransaction();

$result = $transaction->makePayment($transactionID, $otp);
```

## Usage: request Refund Payment

```php

$transaction = new IMaliTransaction();

    $result = $transaction->refundCustomer(
            $partnerTransactionID,
            $paymentTransaction,
            $customerAccountNumber,
            $storeAccountNumber,
            $amount,
            $description,
            $terminalID,
            $terminalChannel,
            $terminalCompanyName,
        );
```

## Usage: confirm request Refund Payment

```php

$transaction = new IMaliTransaction();

   $result = $transaction->refundCustomerConfirmation($partnerTransactionID, $otp);
```
## Usage: get Static Qrcode

```php

$transaction = new IMaliTransaction();

   $result = $transaction->getQRCODE($accountNumber);
```
