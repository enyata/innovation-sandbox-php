# INNOVATION SANDBOX

## Installation

The preferred method of installation is via Composer. Run the following command to install the package and add it as a requirement to your project's composer.json:

```bash
$ composer require enyata/innovation-sandbox
```

## Common Credentials

Below is a list of required credentials.

### sandbox_key

This can be found in the innovation sandbox dashboard after signup. However`0ae0db703c04119b3db7a03d7f854c13` can be used for testing purposes.

### host

This argument is optional in all cases. Defaults to `https://sandboxapi.fsi.ng` if not found.

## Airtime([options])

You can send Send airtime to a bunch of phone numbers.

### options

The module accepts options as array of key-value.

#### payload

Request Body

##### phoneNumber

Recipient of airtime.

##### currencyCode

3-digit ISO format currency code.

##### amount

Amount to charge.

### InnovationSandbox\Atlabs\Airtime\SendAirtime(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\Atlabs\Airtime;
$instance1 = new Airtime();

$this->instance1->SendAirtime(
    '', 
   'your sandbox_key', 
    [
       'recipients' => [
            [
               'phoneNumber' =>'+2340000000000',
               'amount' =>'1000',
               'currencyCode' =>'NGN'
            ]
        ]
    ]);
```

## SMS Service ([options])

You can send SMSs by making a HTTP POST request to the SMS API.

### options

The module accepts options as array of key-value.

#### payload

Request Body

##### to

A String or an array with comma separated string of recipients’ phone numbers.

##### from

Your registered short code or alphanumeric, defaults is FSI.

##### message

The message to be sent.

##### enqueue([optional])

Set to true if you would like to deliver as many messages to the API without waiting for an acknowledgement from telcos.

### InnovationSandbox\Atlabs\SMS\SMSService(credentials)

Below is a sample with test data;


```php
<?php
use InnovationSandbox\Atlabs\SMS;
$instance1 = new SMS();

$instance1->SMSService(
    '', 
   'your sandbox key', 
    [
       'to' =>'+2349091271976',
       'from' =>'FSI',
       'message' =>'Hello World'
    ]);
```

## Premium Subscription([options])

To send premium SMS.

### options

The module accepts options as array of key-value.

#### payload

Request Body

##### to

A comma separated string of recipients’ phone numbers.

##### from

Your registered short code or alphanumeric, defaults is'FSI'.

##### message

The message to be sent.

##### keyword

You premium product keyword'innovation-sandbox'.

##### linkId

We forward the linkId to your application when the user send a message to your service.

##### retryDurationInHours

It specifies the number of hours your subscription message should be retried in case it's not delivered to the subscriber.

### InnovationSandbox\Atlabs\SMS\Premium(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\Atlabs\SMS;
$instance1 = new SMS();

$instance1->Premium(
    '', 
    'your sandbox key', 
    [
       'to' =>'+2349091271976',
       'from' =>'FSI',
       'message' =>'Hello World',
       'keyword' =>'innovation-sandbox',
       'linkId' =>'12345',
       'retryDurationInHours' =>'1'
    ]);
```

## Create Premium Subscription([options])

To create a premium subscription, you first need to create a checkoutToken.

### options

The module accepts options as array of key-value.

#### payload

Request Body

##### shortCode

This is the premium short code mapped to your account.

##### phoneNumber

The phone number to be subscribed.

##### checkoutToken

This is a token used to validate the subscription request.

##### keyword

You premium product keyword'innovation-sandbox'.

### InnovationSandbox\Atlabs\SMS\SMSService(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\Atlabs\SMS;
$instance1 = new SMS();

$instance1->CreatePremium(
    '', 
    'your sandbox key', 
    [
       'phoneNumber' =>'+2349091271976',
       'shortCode' =>'19171',
       'checkoutToken' =>'your-checkout-token',
       'keyword' =>'innovation-sandbox',
    ]);
```

## Delete Premium Subscription([options])

To delete a premium subscription.

### options

The module accepts options as array of key-value.

#### payload

Request Body

##### shortCode

This is the premium short code mapped to your account.

##### phoneNumber

The phone number to be subscribed.

##### keyword

You premium product keyword'innovation-sandbox'.

### InnovationSandbox\Atlabs\SMS\DeletePremium(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\Atlabs\SMS;
$instance1 = new SMS();

$instance1->DeletePremium(
    '', 
   'your sandbox key', 
    [
       'phoneNumber' =>'+2349091271976',
       'shortCode' =>'19171',
       'keyword' =>'innovation-sandbox',
    ]);
```

## Fetch Premium Subscription([options])

Fetch your premium subscription data.

### options

The module accepts options as array of key-value.

#### payload

Request Body

##### shortCode

This is the premium short code mapped to your account.

##### lastReceivedId

This is the id of the message that you last processed. Defaults to 0

##### keyword

You premium product keyword'innovation-sandbox'.

### InnovationSandbox\Atlabs\SMS\FetchPremium(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\Atlabs\SMS;
$instance1 = new SMS();

$instance1->FetchPremium(
    '', 
    'your sandbox key', 
    [
       'lastReceivedId' =>'0',
       'shortCode' =>'19171',
       'keyword' =>'innovation-sandbox',
    ]);
```

## Fetch Messages([options])

Manually retrieve your messages

### options

The module accepts options as array of key-value.

#### payload

Request Body

##### lastReceivedId

This is the id of the message that you last processed. Defaults to 0

### InnovationSandbox\Atlabs\SMS\FetchMessages(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\Atlabs\SMS;
$instance1 = new SMS();

$instance1->FetchMessages('', 'your sandbox key', ['lastReceivedId' =>'0']));
```

## Create Checkout Token([options])

To create a new checkout token.

### options

The module accepts options as array of key-value.

#### payload

Request Body

##### phoneNumber

The phone number to be subscribed.

### InnovationSandbox\Atlabs\Token\CheckoutToken(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\Atlabs\Token;

$instance1 = new Token();
$instance1->CheckoutToken('', 'your sandbox key', ['phoneNumber' =>'+234000000000']);
```

## Voice Call([options])

Initiate a phone call.

### options

The module accepts options as array of key-value.

#### payload

Request Body

##### callFrom

Your Africa's Talking issued virtual phone number.

##### callTo

Phone number to dial.

### InnovationSandbox\Atlabs\Voice\Call(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\Atlabs\Voice;

$instance1 = new Voice();

$instance1->Call('', 'your sandbox key', ['callTo' => '+234000000000','callFrom' =>'FSI']);
```

## Fetch Queue Calls([options])

Get queued calls

### options

The module accepts options as array of key-value.

#### payload

Request Body

##### phoneNumber

Your Africa's Talking issued virtual phone number. 

### InnovationSandbox\Atlabs\Voice\QueueStatus(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\Atlabs\Voice;
$instance1 = new Voice();

$instance1->QueueStatus('', 'your sandbox key', ['phoneNumber' =>'+234000000000']);
```

## Upload Media File([options])

You can upload media/audio file with the extension .mp3 or .wav only. This media files will be played when called upon by one of our voice actions.

### options

The module accepts options as array of key-value.

#### payload

Request Body

##### phoneNumber

Your Africa's Talking issued virtual phone number. 

##### url

URL to your media file 

### InnovationSandbox\Atlabs\Voice\QueueStatus(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\Atlabs\Voice;
$instance1 = new Voice();

$instance1->QueueStatus(
    '', 
    'your sandbox key', 
    [
       'phoneNumber' =>'+234000000000',
       'url' =>'link-to-media-file'
    ]);
```

## RUNNING TEST

After installing dependeinces, run the command 

```bash
$ vendor/bin/phpunit tests
```
