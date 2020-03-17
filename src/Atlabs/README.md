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

### host([optional])
This argument is optional in all cases. Defaults to `https://sandboxapi.fsi.ng` if not found.


## Airtime
You can send Send airtime to a bunch of phone numbers.

### options
The module accepts options as array of key-value.

#### payload
Request Body

##### phoneNumber([required])
Recipient of airtime.

##### currencyCode([required])
3-digit ISO format currency code.

##### amount([required])
Amount to charge.

### InnovationSandbox\Atlabs\Airtime\SendAirtime(credentials)
Below is a sample with test data;


```php
<?php
use InnovationSandbox\Atlabs\Airtime;
$instance1 = new Airtime();

echo $this->instance1->SendAirtime('', "your sandbox_key", [
        "recipients" => [
            [
                "phoneNumber" => "+2340000000000",
                "amount" => "1000",
                "currencyCode" => "NGN"
            ]
        ]
    ]);
```

## SMS Service
You can send SMSs by making a HTTP POST request to the SMS API.

### options
The module accepts options as array of key-value.

#### payload
Request Body

##### to([required])
A String or an array with comma separated string of recipients’ phone numbers.

##### from([required])
Your registered short code or alphanumeric, defaults is FSI.

##### message([required])
The message to be sent.

##### enqueue([optional])
Set to true if you would like to deliver as many messages to the API without waiting for an acknowledgement from telcos.

### InnovationSandbox\Atlabs\SMS\SMSService(credentials)
Below is a sample with test data;


```php
<?php
use InnovationSandbox\Atlabs\SMS;
$instance1 = new SMS();

echo json_encode($instance1->SMSService('', "your sandbox key", [
            "to" => "+2349091271976",
            "from" => "FSI",
            "message" => "Hello World"
    ]));
```

## Premium Subscription
To send premium SMS.

### options
The module accepts options as array of key-value.

#### payload
Request Body

##### to([required])
A comma separated string of recipients’ phone numbers.

##### from([required])
Your registered short code or alphanumeric, defaults is "FSI".

##### message([required])
The message to be sent.

##### keyword([optional])
You premium product keyword "innovation-sandbox".

##### linkId([optional])
We forward the linkId to your application when the user send a message to your service.

##### retryDurationInHours([optional])
It specifies the number of hours your subscription message should be retried in case it's not delivered to the subscriber.

### InnovationSandbox\Atlabs\SMS\Premium(credentials)
Below is a sample with test data;


```php
<?php
use InnovationSandbox\Atlabs\SMS;
$instance1 = new SMS();

echo json_encode($instance1->Premium('', 'your sandbox key', [
    "to" => "+2349091271976",
    "from" => "FSI",
    "message" => "Hello World",
    "keyword" => "innovation-sandbox",
    "linkId" => "12345",
     "retryDurationInHours" => "1"
    ]));
```

## Create Premium Subscription
To create a premium subscription, you first need to create a checkoutToken.

### options
The module accepts options as array of key-value.

#### payload
Request Body

##### shortCode([required])
This is the premium short code mapped to your account.

##### phoneNumber([required])
The phone number to be subscribed.

##### checkoutToken([required])
This is a token used to validate the subscription request.

##### keyword([optional])
You premium product keyword "innovation-sandbox".

### InnovationSandbox\Atlabs\SMS\SMSService(credentials)
Below is a sample with test data;

```php
<?php
use InnovationSandbox\Atlabs\SMS;
$instance1 = new SMS();

echo json_encode($instance1->CreatePremium('', 'your sandbox key', [
            "phoneNumber" => "+2349091271976",
            "shortCode" => "19171",
            "checkoutToken" => "your-checkout-token",
            "keyword" => "innovation-sandbox",
        ]));
```

## Delete Premium Subscription
To delete a premium subscription.

### options
The module accepts options as array of key-value.

#### payload
Request Body

##### shortCode([required])
This is the premium short code mapped to your account.

##### phoneNumber([required])
The phone number to be subscribed.

##### keyword([required])
You premium product keyword "innovation-sandbox".

### InnovationSandbox\Atlabs\SMS\DeletePremium(credentials)
Below is a sample with test data;


```php
<?php
use InnovationSandbox\Atlabs\SMS;
$instance1 = new SMS();

echo json_encode($instance1->DeletePremium('', "your sandbox key", [
            "phoneNumber" => "+2349091271976",
            "shortCode" => "19171",
            "keyword" => "innovation-sandbox",
        ]));
```

## Fetch Premium Subscription
Fetch your premium subscription data.

### options
The module accepts options as array of key-value.

#### payload
Request Body

##### shortCode([required])
This is the premium short code mapped to your account.

##### lastReceivedId([required])
This is the id of the message that you last processed. Defaults to 0

##### keyword([required])
You premium product keyword "innovation-sandbox".

### InnovationSandbox\Atlabs\SMS\FetchPremium(credentials)
Below is a sample with test data;


```php
<?php
use InnovationSandbox\Atlabs\SMS;
$instance1 = new SMS();

echo json_encode($instance1->FetchPremium('', 'your sandbox key', [
            "lastReceivedId" => "0",
            "shortCode" => "19171",
            "keyword" => "innovation-sandbox",
        ]));
```

## Fetch Messages
Manually retrieve your messages

### options
The module accepts options as array of key-value.

#### payload
Request Body

##### lastReceivedId([required])
This is the id of the message that you last processed. Defaults to 0

### InnovationSandbox\Atlabs\SMS\FetchMessages(credentials)
Below is a sample with test data;


```php
<?php
use InnovationSandbox\Atlabs\SMS;
$instance1 = new SMS();

echo json_encode($instance1->FetchMessages('', 'your sandbox key', [
            "lastReceivedId" => "0",
        ]));
```

## Create Checkout Token
To create a new checkout token.

### options
The module accepts options as array of key-value.

#### payload
Request Body

##### phoneNumber([required])
The phone number to be subscribed.

### InnovationSandbox\Atlabs\Token\CheckoutToken(credentials)
Below is a sample with test data;


```php
<?php
use InnovationSandbox\Atlabs\SMS;
$instance1 = new SMS();

echo json_encode($instance1->CheckoutToken('', 'your sandbox key', [
            "phoneNumber" => "+234000000000",
        ]));
```

## Voice Call
Initiate a phone call.

### options
The module accepts options as array of key-value.

#### payload
Request Body

##### callFrom([required])
Your Africa's Talking issued virtual phone number.

##### callTo([required])
Phone number to dial.

### InnovationSandbox\Atlabs\Voice\Call(credentials)
Below is a sample with test data;

```php
<?php
use InnovationSandbox\Atlabs\Voice;
$instance1 = new Voice();

echo json_encode($instance1->Call('', 'your sandbox key', [
            "callTo" => "+234000000000",
            "callFrom" => "FSI"
        ]));
```

## Fetch Queue Calls
Get queued calls

### options
The module accepts options as array of key-value.

#### payload
Request Body

##### phoneNumber([required])
Your Africa's Talking issued virtual phone number. 

### InnovationSandbox\Atlabs\Voice\QueueStatus(credentials)
Below is a sample with test data;

```php
<?php
use InnovationSandbox\Atlabs\Voice;
$instance1 = new Voice();

echo json_encode($instance1->QueueStatus('', 'your sandbox key', [
            "phoneNumber" => "+234000000000",
        ]));
```

## Upload Media File
You can upload media/audio file with the extension .mp3 or .wav only. This media files will be played when called upon by one of our voice actions.

### options
The module accepts options as array of key-value.

#### payload
Request Body

##### phoneNumber([required])
Your Africa's Talking issued virtual phone number. 

##### url([required])
URL to your media file 

### InnovationSandbox\Atlabs\Voice\QueueStatus(credentials)
Below is a sample with test data;

```php
<?php
use InnovationSandbox\Atlabs\Voice;
$instance1 = new Voice();

echo json_encode($instance1->QueueStatus('', 'your sandbox key', [
            "phoneNumber" => "+234000000000",
            "url" => "link-to-media-file"
        ]));
```

## RUNNING TEST
After installing dependeinces, run the command 
```bash
$ vendor/bin/phpunit tests
```
