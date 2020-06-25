# INNOVATION SANDBOX

## Install

The recommended way to install innovation-sandbox is through Composer.

```bash
$ composer require enyata/innovation-sandbox
```

## Common Credentials

Below is a list of required credentials.

### sandbox_key

This can be found in the innovation sandbox dashboard after sign up.

### host

This argument is optional in all cases. Defaults to `https://sandboxapi.fsi.ng` if not found.

### subscription_key

Subscription key which provides access to this API. Found in your Profile.

### Appid

Application ID

### ipval

ip value

## Interbank Name Enquiry([options])

You can query and confirm account details using a valid NUBAN, in any bank.

### options

The module accepts options as an array of key-value.

#### params

Query Params

##### Referenceid

This is the unique number that identifies transactions/request.

##### RequestType

The is the type of the request being processed.

##### Translocation

GPS of the originating location of the transaction in longitude & latitude.

##### ToAccount

This is the NUBAN of the transaction recipient account.

##### destinationbankcode

This is the destination bank's code

### InnovationSandbox\Sterling\Transfer\InterbankNameEnquiry(credentials)

In additions to the credentials stated above a 'params' key with additional request credentials as array of key values should be added to the array. For example

```php
<?php
use InnovationSandbox\Sterling\Transfer;

$instance = new Transfer();

echo json_encode($instance->InterbankNameEnquiry([
    'host' => 'Your host url',
    'sandbox_key' => 'Your sandbox_key',
    'subscription_key' => 't',
    'Appid' => 69,
    'ipval' => 0,
    'params' => [
        'Referenceid' => '01',
		  'RequestType' => '01',
		  'Translocation' => '01',
		  'ToAccount' => '0037514056',
		  'destinationbankcode' => '00001'
    ]
    ]));
```

## Interbank Transfer([options])

You can transfer funds from one bank or a financial institution to another.

### options

The module accepts options as array of key-value.

#### payload

Request Body

##### Referenceid

This is the unique number that identifies transactions/request.

##### RequestType

The is the type of request being processed.

##### SessionID

The is the session id.

##### FromAccount

This is the NUBAN of the transaction sender account.

##### ToAccount

This is the NUBAN of the transaction recipient account.

##### Amount

This is the amount sent.

##### Destinationbankcode

This is the destination bank's code

##### NEResponse

##### BenefiName

##### PaymentReference

##### OriginatorAccountName

##### translocation

### InnovationSandbox\Sterling\Account\InterbankTransferReq(credentials)

In additions to the credentials stated above a 'payload' key with addition request credentials as object of key values should be added to the object. For example

```php
<?php
use InnovationSandbox\Sterling\Account;

$instance = new Account();

echo json_encode($instance->InterbankTransferReq([
        'sandbox_key' => 'Your sandbox_key',
        'subscription_key' => 't',
        'Appid' => 69,
        'ipval' => 0,
        'payload'  => [
            'Referenceid' => '0101',
            'RequestType' => '01',
            'Translocation' => '0101',
            'SessionID' => '01',
            'FromAccount' => '01',
            'ToAccount' => '01',
            'Amount' => '01',
            'DestinationBankCode' => '01',
            'NEResponse' => '01',
            'BenefiName' => '01',
            'PaymentReference' => '01',
            'OriginatorAccountName' => '01',
            'translocation' => '01'
        ]
        ]));
```

## Mobile Wallet([options])

Want to perform wallet transactions? It works best with our Mobile Wallet API.

### options

The module accepts options as array of key-value.

#### payload

Request Body

##### Referenceid

This is the unique number that identifies transactions/request.

##### RequestType

The is the type of request being processed.

##### Translocation

##### amt

##### tellerid

##### frmacct

##### toacct

##### exp_code

##### paymentRef

##### remarks

### InnovationSandbox\Sterling\Wallet\Mobile(credentials)

In additions to the credentials stated above a 'payload' key with addition request credentials as object of key values should be added to the object. For example

```php
<?php
use InnovationSandbox\Sterling\Wallet;

$instance = new Wallet();

echo json_encode($instance->Mobile([
        'sandbox_key' => 'Your sandbox_key',
        'subscription_key' => 't',
        'payload'  => [
               "Referenceid" => "01",
               "RequestType" => "0",
               "Translocation" => "01",
               "amt" => "Billing Amount || 2000",
               "tellerid" => "Teller ID || 0451",
               "frmacct" => "Transaction Sender Account || 0051561375",
               "toacct" => "Transaction Recipient Account || 0037514056",
               "exp_code" => "Transaction exp code || 01",
               "paymentRef" => "Input Payment Reference || 01",
               "remarks" => "Transaction remarks || Monthly subscription"
        ]
        ]));
```

## BillPaymtAdvice([options])

This provides the list of all billing services available to a particular billing company.

### options

The module accepts options as array of key-value.

#### payload

Request Body

##### Referenceid

This is the unique number that identifies transactions/request.

##### RequestType

The is the type of request being processed.

##### Translocation

##### amt

##### paymentcode

##### mobile

##### toacct

#####  SubscriberInfo1

##### ActionType

##### nuban

##### email

### InnovationSandbox\Sterling\BillPayment\BillPaymtAdvice(credentials)

In additions to the credentials stated above a 'payload' key with addition request credentials as object of key values should be added to the object. For example

```php
<?php
use InnovationSandbox\Sterling\BillPayment;

$instance = new BillPayment();

echo json_encode($instance->BillPaymtAdvice([
        'sandbox_key' => 'Your sandbox_key',
        'subscription_key' => 't',
        'payload'  => [
            "Referenceid" => "01",
            "RequestType" => "0",
            "Translocation" => "01",
            "amt" => "Billing Amount || 2000",
            "paymentcode" => "Billing Payment Code || 01",
            "mobile" => "Sender Mobile Number || 08051561375",
            "SubscriberInfo1" => "Subscriber Information || 0037514056",
            "ActionType" => "Type Of Billing Action || 01",
            "nuban" => "Sender Account Number || 0037514056",
            "email" => "Sender Email Address || sender@gmail.com"
        ]
        ]));
```

## BillersPaymentItems([options])

This provides the list of all billing services available to a particular billing company.

### options

The module accepts options as array of key-value.

#### payload

Request Params

##### Referenceid

This is the unique number that identifies transactions/request.

##### RequestType

The is the type of request being processed.

##### Translocation

##### Bvn

##### billerid

### InnovationSandbox\Sterling\BillPayment\BillersPaymentItems(credentials)

In additions to the credentials stated above a 'payload' key with addition request credentials as object of key values should be added to the object. For example

```php
<?php
use InnovationSandbox\Sterling\BillPayment;

$instance = new BillPayment();

echo json_encode($instance->BillersPaymentItems([
        'sandbox_key' => 'Your sandbox_key',
        'subscription_key' => 't',
        'params'  => [
            "Referenceid" => "01",
            "RequestType" => "0",
            "Translocation" => "01",
            "Bvn" => "any: Account BVN Number || 2098765428",
            "billerid" => "Biller Service Identity || 002"
        ]
        ]));
```

## BillersISW([options])

This provides the list of all billing services available to a particular billing company.

### options

The module accepts options as array of key-value.

#### payload

Request Params

##### Referenceid

This is the unique number that identifies transactions/request.

##### RequestType

The is the type of request being processed.

##### Translocation

##### Bvn

### InnovationSandbox\Sterling\BillPayment\BillersISW(credentials)

In additions to the credentials stated above a 'payload' key with addition request credentials as object of key values should be added to the object. For example

```php
<?php
use InnovationSandbox\Sterling\BillPayment;

$instance = new BillPayment();

echo json_encode($instance->BillersISW([
        'sandbox_key' => 'Your sandbox_key',
        'subscription_key' => 't',
        'params'  => [
            "Referenceid" => "01",
            "RequestType" => "0",
            "Translocation" => "01",
            "Bvn" => "Account BVN Number || 2098765428"
        ]
        ]));
```

## RUNNING TEST

After installing dependencies, run the command

```bash
$ vendor/bin/phpunit tests
```
