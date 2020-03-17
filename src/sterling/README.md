# INNOVATION SANDBOX

## Install
The recommended way to install innovation-sandbox is through Composer.

```bash
$ composer require enyata/innovation-sandbox
```

## Common Credentials
Below is a list of required credentials.

### sandbox_key
This can be found in the innovation sandbox dashboard after signup. However `0ae0db703c04119b3db7a03d7f854c13` can be used for testing purposes.

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
This is the nuban of the transaction recipient account.

##### destinationbankcode
This is the destination bank's code



### InnovationSandbox\Sterling\Transfer\InterbankNameEnquiry(credentials)
In additions to the credentials stated above a 'params' key with additional request credentials as array of key values should be added to the array. For example

```php
<?php
use InnovationSandbox\Sterling\Transfer;

$instance = new Transfer();

echo json_encode($instance->InterbankNameEnquiry([
    "host" => 'Your host url',
    "sandbox_key" => 'Your sandbox_key',
    "subscription_key" => "Your Subscription Key",
    "Appid" => "Your App ID",
    "ipval" => "Your IP",
    "params" => [
        "Referenceid" => "Your Transaction ID",
		  "RequestType" => "Transaction Type",
		  "Translocation" => "Transaction Location Longitude Latitude",
		  "ToAccount" => "Transaction Recipient Account",
		  "destinationbankcode" => "Destination Bank Code"
    ]
    ]));
```

## Interbank Transfer([options])
You can transfer funds from one bank or a financial insitution to another.

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
This is the nuban of the transaction sender account.

##### ToAccount
This is the nuban of the transaction recipient account.

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

echo json_encode($instance5->InterbankTransferReq([
        "sandbox_key" => "0ae0db703c04119b3db7a03d7f854c13",
        "subscription_key" => "t",
        "Appid" => 69,
        "ipval" => 0,
        "payload"  => [
            "Referenceid" => "0101",
            "RequestType" => "0101",
            "Translocation" => "0101",
            "SessionID" => "01",
            "FromAccount" => "01",
            "ToAccount" => "01",
            "Amount" => "01",
            "DestinationBankCode" => "01",
            "NEResponse" => "01",
            "BenefiName" => "01",
            "PaymentReference" => "01",
            "OriginatorAccountName" => "01",
            "translocation" => "01"
        ]
        ]));
```

## RUNNING TEST
After installing dependeinces, run the command 
```bash
$ vendor/bin/phpunit tests
```
