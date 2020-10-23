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
ip value

## Optional Credentials

Below is a list of optional credentials.

### content-type

It is used in the header. What it takes varies by API.

## *Oauth2 Authorization([options])*

Token Authorization

### options

The module accepts options as an array of key-value.

## payload

Request Body

### *username*

username used for registration

### *password*

password used for registration

### *grant_type*

## header

Request Header

### consumer_key

Your consumer key

### consumer_secret

Your consumer secret

### content-type

## InnovationSandbox\SWIFT\Authorization(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\SWIFT\Authorization;
$instance1 = new Authorization();

$this->instance1->oauth2(
    '',
    'your sandbox_key',
    "consumer_key" => "Your customer key || umNvx0EX2LelvDuoG4L4LMA0w2uKAApX",
    "consumer_secret" => "Your customer secret || blOzfCw2tTtGU9xu",
    "payload" => [
        "username" => "Registration Username || aerbukfvdsf",
        "password" => "Registration Password || efjvqhdfbvajdfbnvjadf",
        "grant_type" => "Grant Type || password"
    ]);
```
___

## *API Payment Status Tracker([options])*

This API is a status confirmation update to inform the Tracker about the updated status of a given payment.

### options

The module accepts options as array of key-value.

## header

Request Header

### access_token

Your access token returned from calling the authorization endpoint

### content-type

## InnovationSandbox\SWIFT\SwiftAPITracker\Status(credentials)

Below is a sample with test data;

```php

<?php
use InnovationSandbox\SWIFT\SwiftAPITracker;
$instance1 = new SwiftAPITracker();

$this->instance1->Status(
    "sandbox_key" => "your sandbox_key",
    "payment_id" => "Your Payment  ID || 123456tyty",
    "access_token" => "Your Access Token || o3VaGWKuDyE9fWAP8uv0Vy09s0Tb"
```
___

## *API Payment Transaction Details([options])*

This API is a payment query to get detailed information regarding a given payment. It requires the UETR to be known.

### options

The module accepts options as objects of key-value.

## header

Request Header

### access_token

Your access token

### content-type

## InnovationSandbox\SWIFT\SwiftAPITracker\Transaction(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\SWIFT\SwiftAPITracker;
$instance1 = new SwiftAPITracker();

$this->instance1->Transaction(
    "sandbox_key" => "your sandbox_key",
    "payment_id" => "Your Payment  ID || 123456tyty",
    "access_token" => "Your Access Token || o3VaGWKuDyE9fWAP8uv0Vy09s0Tb"
```
___

## *API Payment Cancellation([options])*

This provides the list of all billing services available to a particular billing company.

### options

The module accepts options as objects of key-value.

## payload

Request Body

### *rom*

Rom

### *business_service*

Business Service

### *case_identification*

Case identification

### *cancellation_reason_information*

Reasons for cancellation

## header

Request Header

### sandbox_key

This can be found in the innovation sandbox dashboard after sign up.

### access_token

Your access token

### content-type

## InnovationSandbox\SWIFT\SwiftAPITracker\Cancellation(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\SWIFT\SwiftAPITracker;
$instance1 = new SwiftAPITracker();

$this->instance1->Cancellation(
    "sandbox_key" => "your sandbox_key",
    "access_token" => "Your Access Token || o3VaGWKuDyE9fWAP8uv0Vy09s0Tb",
    "payment_id" => "Your Payment  ID || 123456tyty",
    "payload" => [
    "rom" => 'BANABEBBXXX',
    "business_service" => '002',
    "case_identification" => '123',
    "cancellation_reason_information" => 'DUPL'
    ]
```
___

## *swift preval pilot([options])*

Verify that a beneficiary account could be able to receive incoming funds.

## payload

Request Body

### *correlation_identifier*

Correllation Identifier

### *context*

Context

### *uetr*

### *creditor_account*

Creditors Account Number

### *creditor_name*

Creditor Account Nmae

### *creditor_address*

Creditor Adddress

### *creditor_organisation_identification*

Creditor Organisation Identification

## header

Request Header

### LAUApplicationID

### LAUCallTim

### LAURequestNonce

### LAUVersion

### x-api-key

### LAUSignature

### LAUSigned

### content-type

## InnovationSandbox\SWIFT\SwiftPrevalPilot\Verification(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\SWIFT\SwiftPrevalPilot;
$instance1 = new SwiftPrevalPilot();

$this->instance1->Verification(
    "sandbox_key" =>  "Your sandbox key",
    "content-type" =>  "application/json",
    "LAUApplicationID" =>  "LAU Application Id || 001",
    "LAUCallTime" =>  "LAU Call Time || Id2018-03-23T15 => 56 => 26.728Z",
    "LAURequestNonce" =>  "LAU Request Nonce || e802ab96-bb3a-4965-9139-5214b9f0f074",
    "LAUVersion" =>  "LAU Version || 1.0",
    "x-api-key" =>  "X API Key || umNvx0EX2LelvDuoG4L4LMA0w2uKAApX",
    "LAUSignature" =>  "LAU Signature || U1khA8h9Lm1PqzB99fG6uw==",
    "LAUSigned" =>  "LAU Signed (ApplAPIKey, x-bic) || (ApplAPIKey=umNvx0EX2LelvDuoG4L4LMA0w2uKAApX),(x-bic=1234567890)",
    "payload" =>   [
        "correlation_identifier" =>  "Correllation Identifier || SCENARIO1-CORRID-002",
        "context" =>  "Context || BENR",
        "uetr" =>  "UETR || b916a97d-a699-4f20-b8c2-2b07e2684a27",
        "creditor_account" =>  "Creditor Account || GB3112000000001987426375",
        "creditor_name" =>  "Creditor Name || John Doe",
        "creditor_address" =>  [ "country" =>  "Country || GB" ],
        "creditor_organisation_identification" =>  ["any_bic" =>  "Any Bic || BANABEBB"]
    ]);
```
___


## *Swift GPI for Corporate Transaction([options])*

This API provides the status of all Pay and trace transactions that have been updated within the specified time frame.

### options

The module accepts options as objects of key-value.

## header

Request Header

### access_token

Your access token

### x-bic

Your x-bic

### client

client

### content-type

## InnovationSandbox\SWIFT\SwiftGPICorporate\Transactions(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\SWIFT\SwiftGPICorporate;
$instance1 = new SwiftGPICorporate();

$this->instance1->transactions(
    "sandbox_key" => "your sandbox_key",
    "content-type": "application/json",
    "access_token" => "Your Access Token || o3VaGWKuDyE9fWAP8uv0Vy09s0Tb",
    "x-bic" : "Your X-BIC || 1234567890",
    "client" => "Client || cclabeb0"
)
```
___

## *Swift GPI for Corporate inbound([options])*

This API provides the status of all Inbound tracking transactions that have been updated within the specified time frame.

### options

The module accepts options as objects of key-value.

## header

Request Header

### sandbox_key

This can be found in the innovation sandbox dashboard after sign up.

### access_token

Your access token

### x-bic

Your x-bic

### client

client

### content-type

## query

Query Params

### status

transaction status

## InnovationSandbox\SWIFT\SwiftGPICorporate\Inbound(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\SWIFT\SwiftGPICorporate;
$instance1 = new SwiftGPICorporate();

$this->instance1->Inbound(
    "sandbox_key" => "your sandbox_key",
    "content-type": "application/json",
    "access_token" => "Your Access Token || o3VaGWKuDyE9fWAP8uv0Vy09s0Tb",
    "x-bic" : "Your X-BIC || 1234567890",
    "client" => "Client || cclabeb0"
    "params" => [
        "status" => "Status || ACCC"
    ]
)
```
___

## *Swift KYC Entity List([options])*

This API is a list retrieval query that enables you to extract a list of all entities which belong to your KYC group.

### options

The module accepts options as objects of key-value.

## header

Request Header

### access_token

Your access token

### content-type

## InnovationSandbox\SWIFT\KYC\EntityList(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\SWIFT\KYC;
$instance1 = new KYC();

$this->instance1->EntityList(
    "sandbox_key" => "your sandbox_key",
    "content-type": "application/json",
    "access_token" => "Your Access Token || o3VaGWKuDyE9fWAP8uv0Vy09s0Tb"
)
```
___

## *Swift Kyc Counter Party([options])*

This API is a list retrieval query that enables you to extract a list of all counterparties which granted access to your KYC group.'

### options

The module accepts options as objects of key-value.

## header

Request Header

### access_token

Your access token

### content-type

## InnovationSandbox\SWIFT\KYC\CounterParty(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\SWIFT\KYC;
$instance1 = new KYC();

$this->instance1->CounterParty(
    "sandbox_key" => "your sandbox_key",
    "content-type": "application/json",
    "access_token" => "Your Access Token || o3VaGWKuDyE9fWAP8uv0Vy09s0Tb"
)
```
## RUNNING TEST

After installing dependencies, run the command

```bash
$ vendor/bin/phpunit tests
```
