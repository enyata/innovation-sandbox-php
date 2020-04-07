# INNOVATION SANDBOX

## Installation

The preferred method of installation is via Composer. Run the following command to install the package and add it as a requirement to your project's composer.json:

```bash
$ composer require enyata/innovation-sandbox
```

## Common Credentials

Below is a list of required credentials.

### sandbox_key

This can be found in the innovation sandbox dashboard after sign up.

### host

This argument is optional in all cases. Defaults to `https://sandboxapi.fsi.ng` if not found.

## Token([options])

You can generate a one-time access code also known as token for a UBN-MiServe transaction.

### options

The module accepts options as array of key-value.

#### payload

Request Body

##### client_secret

##### client_id

##### grant_type

##### Password

##### username

### InnovationSandbox\Union\Token\GenerateToken(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\Union\Token;
$instance1 = new Token();

$this->instance1->GenerateToken(
    '',
    'your sandbox_key',
    [
        'client_secret' => 'secret',
        'client_id' => 'web01',
        'grant_type' =>	'password',
        'username' => 'ubnclient01',
        'password' => 'w$777'
    ]);
```

## Account Enquiry ([options])

This operation provides basic account information of CASA or GL.

### options

The module accepts options as array of key-value.

#### payload

Request Body

##### accountNumber

Account number to be queried.

##### accountType([optional])

Account type. Default CASA.

### InnovationSandbox\Union\Enquiry\Account(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\Union\Enquiry;
$instance1 = new Enquiry();

$instance1->Account(
    '',
   'your sandbox key',
    [
       'accountNumber' =>'0000791200',
       'accountType' =>'CASA',
    ],
    'your access_token'
    );
```

## Customer Enquiry([options])

This operation provides basic customer information of CASA or GL.

### options

The module accepts options as array of key-value.

#### payload

Request Body

##### accountNumber

Account number to be queried.

##### accountType([optional])

Account type. Default CASA

### InnovationSandbox\Union\Enquiry\Customer(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\Union\Enquiry;
$instance1 = new Enquiry();

$instance1->Customer(
    '',
    'your sandbox key',
    [
       'accountNumber' => '+0000791200',
       'accountType' => 'CASA',
    ],
    'access_token');
```

## Customer and Account Enquiry ([options])

This operation enables client to do customer and account enquiry with a single call. The return
message contains both customer and account information.

### options

The module accepts options as array of key-value.

#### payload

Request Body

##### accountNumber

Account number to be queried

##### accountType

Account type. Default CASA

### InnovationSandbox\Union\Enquiry\CustomerAndAccount(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\Union\Enquiry;
$instance1 = new Enquiry();

$instance1->CustomerAccount(
    '',
    'your sandbox key',
    [
       'accountNumber' =>'0000791200',
       'accountType' =>'CASA',
    ],
    'your access_token'
    );
```

## Change User Credentials ([options])

This operation enables client to change password.

### options

The module accepts options as array of key-value.

#### payload

Request Body

##### username

Reference number used to hold funds.

##### oldPassword

Current password

##### Password

New password

##### ModuleId

Client module ID

##### clientSecret

Client secret

### InnovationSandbox\Union\User\UpdateCredentials(credentials)

Below is a sample with test data;

```php
<?php
use InnovationSandbox\Union\User;
$instance1 = new User();

$instance1->UpdateCredentials(
    '',
   'your sandbox key',
    [
       'username' =>'user1',
       'oldPassword' =>'password2',
       'password' =>'password',
       'moduleId' =>'"UNION_ONE',
       'clientSecret' =>'ABC',
    ]);
```

## RUNNING TEST

After installing dependencies, run the command

```bash
$ vendor/bin/phpunit tests
```
