# INNOVATION SANDBOX

## Install
The recommended way to install innovation-sandbox is through Composer.

```bash
$ composer require enyata/innovation-sandbox
```

## RESET_TOKEN([Options])
This should be done on every initialization.

### Options
The module accepts options as an array of key-value and returns aes_key, ivkey and password.

#### sandbox_key
This can be found in the innovation sandbox dashboard after sign up. 

#### organisation_code
This credential is gotten from NIBSS prior to acquiring this credential, 11111 should be used for testing.

##### host
This argument is optional in all cases. Defaults to `https://sandboxapi.fsi.ng` if not found.

### InnovationSandbox\NIBSS\Bvnr\Reset(credentials)
Returns the aes_key, ivey and password. As earlier stated this function should be called at every initialization. The credentials returned is set as part of the data for accessing other NIBSS modules.

The following example calls the reset module
```php
<?php
use InnovationSandbox\NIBSS\Bvnr;
$instance1 = new Bvnr();
$instance1->Reset([sandbox_key =>'Your sandbox_key', organisation_code => 'Your organisation_code'])

```

Below is an example of a reset result:
```php
[
  password: 'password',
  ivkey: 'Your ivykey',
  aes_key: 'Your aes_key'
]
```

## USING CREDENTIALS
Once the credentials from the reset module has been acquired it should be appended as an array alongside the organization_code, host and sandbox_key as part of the credentials to every request made to the NIBSS API.

### Verify Single BVN
Verifies single BVN

#### InnovationSandbox\NIBSS\Bvnr\VerifySingleBVN(credentials)
In additions to the credentials stated above a 'bvn' key with the value of the bvn number to be verified as a string should be added to the array. For example

```php
<?php
use InnovationSandbox\NIBSS\Bvnr;

$instance1 = new Bvnr();

$instance1->VerifySingleBVN([
    bvn => 'BVN',
    sandbox_key => 'Your sandbox_key',
    organisation_code => 'Your organisation_code',
    password => 'Your password',
    ivkey => 'Your ivkey',
    aes_key => 'Your aes_key',
    host => 'Your host url'
])
```

### Verify Multiple BVN
Verifies more than one BVN

#### InnovationSandbox\NIBSS\Bvnr\VerifyMultipleBVN(credentials)
Credentials are same as VerifySingleBVN. The BVNs are separated by comma. For example

```php
<?php
use InnovationSandbox\NIBSS\Bvnr;

$instance1 = new Bvnr();

$instance1->VerifySingleBVN([
    bvn => 'BVN1, BVN2, ...BVNn',
    sandbox_key => 'Your sandbox_key',
    organisation_code => 'Your organisation_code',
    password => 'Your password',
    ivkey => 'Your ivkey',
    aes_key => 'Your aes_key',
    host => 'Your host url'
])
```
Note: This module accepts a maximum of 10 BVNs as the bvn value.

### GET SINGLE BVN
Gets single BVN

#### InnovationSandbox\NIBSS\Bvnr\GetSingleBVN(credentials)
Credentials are same as VerifySingleBVN. 

```php
<?php
use InnovationSandbox\NIBSS\Bvnr;

$instance1 = new Bvnr();

$instance1->GetSingleBVN([
    bvn => 'BVN',
    sandbox_key => 'Your sandbox_key',
    organisation_code => 'Your organisation_code',
    password => 'Your password',
    ivkey => 'Your ivkey',
    aes_key => 'Your aes_key',
    host => 'Your host url'
])
```

### GET Multiple BVN
Gets multiple BVN

#### InnovationSandbox\NIBSS\Bvnr\GetMultipleBVN(credentials)
Credentials are same as VerifyMultipleBVN.

```php
<?php
use InnovationSandbox\NIBSS\Bvnr;

$instance1 = new Bvnr();

$instance1->VerifySingleBVN({
    bvn => 'BVN1, BVN2, ...BVNn',
    sandbox_key => 'Your sandbox_key',
    organisation_code => 'Your organisation_code',
    password => 'Your password',
    ivkey => 'Your ivkey',
    aes_key => 'Your aes_key',
    host => 'Your host url'
})
```

### Is BVN Watchlisted
Verifies if BVN has been watch listed.

#### InnovationSandbox\NIBSS\Bvnr\IsBVNWatchlisted(credentials)
Credentials are same as VerifySingleBVN.

```php
<?php
use InnovationSandbox\NIBSS\Bvnr;

$instance1 = new Bvnr();

$instance1->IsBVNWatchlisted({
    bvn => 'BVN',
    sandbox_key => 'Your sandbox_key',
    organisation_code => 'Your organisation_code',
    password => 'Your password',
    ivkey => 'Your ivkey',
    aes_key => 'Your aes_key',
    host => 'Your host url'
})
```

### Verify Finger Print
Verifies finger print

#### InnovationSandbox\NIBSS\FingerPrint\VerifyFingerPrint(credentials)
Credentials are same as VerifySingleBVN. The 'bvn' key is replaced with 'fingerPrintData' key which is an array containing details about the finger print. Below are the keys required for the fingerPrintData array.

```php
fingerPrintData => [
    'BVN' => 'BVN',
    'DeviceId' => 'Your Device Number',
    'ReferenceNumber' => 'Your device reference number',
    'FingerImage' => [
        'type' => 'image type',
        'position' => 'image position',
        'nist_impression_type' => 'impression type',
        'value' => 'impression value',
    ]'
],
```

Below is an example on how to verify finger print

```php
<?php
use InnovationSandbox\NIBSS\FingerPrint;

$instance1 = new FingerPrint();

$instance1->VerifyFingerPrint([
    fingerPrintData: [
                fingerPrintData: [
                BVN => '12345678901',
                DeviceId => 'Z000112BC12',
                ReferenceNumber => '00099201710012205354422',
                FingerImage => [
                    type => 'ISO_2005',
                    position => 'RT',
                    nist_impression_type => '0',
                    value => 'c2RzZnNkZnNzZGY=',
                ]
    ],
    sandbox_key => 'Your sandbox_key',
    organisation_code => 'Your organisation_code',
    password => 'Your password',
    ivkey => 'Your ivkey',
    aes_key => 'Your aes_key',
    host => 'Your host url'
])
```

### Validate Single Record
Validates single record

#### InnovationSandbox\NIBSS\PlaceHolder\ValidateRecord(credentials)
Credentials are same as VerifySingleBVN. The 'bvn' key is replaced with 'Record' key which is an array containing details about the BVN record.

```php
<?php
use InnovationSandbox\NIBSS\PlaceHolder;

$instance1 = new PlaceHolder();

$instance1->ValidateRecords([
    Record: [
                BVN => 'BVN',
                FirstName => 'Owner First Name',
                LastName => 'Owner Last name',
                MiddleName => 'Owner Middle Name',
                AccountNumber => 'Owner Account Number',
                BankCode => 'Bank Code',
    ],
    sandbox_key => 'Your sandbox_key',
    organisation_code => 'Your organisation_code',
    password => 'Your password',
    ivkey => 'Your ivkey',
    aes_key => 'Your aes_key',
    host => 'Your host url'
])
```

### Validate Multiple Records
Validates multiple records

#### InnovationSandbox\NIBSS\PlaceHolder\ValidateRecords(credentials)
Credentials are same as VerifySingleBVN. The 'bvn' key is replaced with 'Records' key which is an array of arrays containing details about the BVN record.

```php
<?php
use InnovationSandbox\NIBSS\PlaceHolder;

$instance1 = new PlaceHolder();

$instance1->ValidateRecords({
    Records: [
                [
                    BVN => 'BVN1',
                    FirstName => 'Owner1 First Name',
                    LastName => 'Owner1 Last name',
                    MiddleName => 'Owner1 Middle Name',
                    AccountNumber => 'Owner1 Account Number',
                    BankCode => 'Bank Code',
                ],
                [
                    BVN => 'BVN2',
                    FirstName => 'Owner2 First Name',
                    LastName => 'Owner2 Last name',
                    MiddleName => 'Owner2 Middle Name',
                    AccountNumber => 'Owner2 Account Number',
                    BankCode => 'Bank Code',
            ],
            ],
    sandbox_key => 'Your sandbox_key',
    organisation_code => 'Your organisation_code',
    password => 'Your password',
    ivkey => 'Your ivkey',
    aes_key => 'Your aes_key',
    host => 'Your host url'
})
```

## RUNNING TEST
After installing dependencies, run the command 
```bash
$ vendor/bin/phpunit tests
```
