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
php artisan vendor:publish --tag=imali-config

**Set your key on this file to make requests**
:file name is imali.php

```php
<?php
return [
    'production' => false,  
    'database' => false,
    'apiKey' => 'Bearer yourKey',
    'localization' => 'en'
];
production 
false-> test server 
true to production server

database
true - will save requests of payments and refunds to your database

localization - allows you to have responses in desired language, you can set en or pt

apiKey should be diferent for test server to production server

```
## Usage: generate dynamic QRcode

```php

$transaction = new IMaliTransaction();

    $result = $transaction->generateTransaction(
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

   $result = $transaction->generatePayment(
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

$result = $transaction->confirmPayment($transactionID, $otp);
```

## Usage: request Refund Payment

```php

$transaction = new IMaliTransaction();

    $result = $transaction->requestRefundCustomer(
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
