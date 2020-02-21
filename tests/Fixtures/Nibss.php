<?php
require_once './vendor/autoload.php';

class Nibss {
    private $faker, $organisation_code, $sandbox_key;
    
    public function __construct(){
        $this->faker = Faker\Factory::create();
        $this->sandbox_key = 'abcdefghijklmnop';
        $this->organisation_code = '00000';
    }

    public function ResetRequest(){
        return [
                'sandbox_key' => $this->sandbox_key,
                'organisation_code' => $this->organisation_code      
        ];
    }

    public function ResetResponse(){
        return [
            'Server' => 'Cowboy',
            'aes_key' => $this->faker->regexify('[A-Za-z0-9]{16}'),
            'Responsecode' => '00',
            'password' => $this->faker->regexify('[A-Za-z0-9]{7}'),
            'ivkey' => $this->faker->regexify('[A-Za-z0-9]{16}'),
        ];
    }

    public function singleBVNRequest() {
        return [
            'bvn' => $this->faker->regexify('[0-9]{10}'),
            'sandbox_key' => $this->sandbox_key,
            'organisation_code' => $this->organisation_code,
            'aes_key' => 'abcdefghijklmnop',
            'password' => 'abcdefghijklmnop',
            'ivkey' => 'abcdefghijklmnop', 
        ];
    }

    public function singleBVNResponse() {
        return [
            'message' => 'OK',
            'data' => [
            'ResponseCode'  => '00',
            'BVN' => $this->faker->regexify('[0-9]{10}'),
            'FirstName' => $this->faker->name(),
            'MiddleName' => $this->faker->name(),
            'LastName' => $this->faker->name(),
            'DateOfBirth' => '22-Oct-1970',
            'PhoneNumber' => $this->faker->regexify('[0-9]{10}'),
            'RegistrationDate' => '16-Nov-2014',
            'EnrollmentBank' => $this->faker->regexify('[0-9]{3}'),
            'EnrollmentBranch' => $this->faker->address(),
            'WatchListed' => 'NO'
            ]
        ];
    }

    public function multipleBVNRequest() {
        return [
            'bvn' => ''.$this->faker->regexify('[0-9]{10}').', '.$this->faker->regexify('[0-9]{10}'),
            'sandbox_key' => $this->sandbox_key,
            'organisation_code' => $this->organisation_code,
            'aes_key' => 'abcdefghijklmnop',
            'password' => 'abcdefghijklmnop',
            'ivkey' => 'abcdefghijklmnop', 
        ];
    }

    public function multipleBVNResponse() {
        return [
            'message' => 'OK',
            'data' => [
                'ResponseCode' => '00',
                'ValidationResponses' => [
                    [
                        'BVN' => $this->faker->regexify('[0-9]{10}'),
                        'FirstName' => $this->faker->name(),
                        'MiddleName' => $this->faker->name(),
                        'LastName' => $this->faker->name(),
                        'DateOfBirth' => '22-Oct-1970',
                        'PhoneNumber' => $this->faker->regexify('[0-9]{10}'),
                        'RegistrationDate' => '16-Nov-2014',
                        'EnrollmentBank' => $this->faker->regexify('[0-9]{3}'),
                        'EnrollmentBranch' => $this->faker->address(),
                        'WatchListed' => 'NO'
                    ],
                    [
                        'BVN' => $this->faker->regexify('[0-9]{10}'),
                        'FirstName' => $this->faker->name(),
                        'MiddleName' => $this->faker->name(),
                        'LastName' => $this->faker->name(),
                        'DateOfBirth' => '22-Oct-1970',
                        'PhoneNumber' => $this->faker->regexify('[0-9]{10}'),
                        'RegistrationDate' => '16-Nov-2014',
                        'EnrollmentBank' => $this->faker->regexify('[0-9]{3}'),
                        'EnrollmentBranch' => $this->faker->address(),
                        'WatchListed' => 'NO'
                    ]
                ]
            ]
        ];
    }

    public function watchListedBVNResponse() {
        return [
            'message' => 'OK',
            'data' => [
            'ResponseCode' => '00',
            'BVN' => $this->faker->regexify('[0-9]{10}'),
            'BankCode' => $this->faker->regexify('[0-9]{3}'),
            'Category' => $this->faker->regexify('[0-9]{1}'),
            'WatchListed' => 'NO'
            ]
        ];
    }

    public function fingerPrintRequest() {
        return [
            'sandbox_key' => $this->sandbox_key,
            'organisation_code' => $this->organisation_code,
            'fingerPrintData'  => [
                'BVN' => $this->faker->regexify('[0-9]{10}'),
                'DeviceId' => $this->faker->regexify('[A-Za-z0-9]{10}'),
                'ReferenceNumber' => $this->faker->regexify('[0-9]{23}'),
                'FingerImage' => [
                    'type' => 'ISO_2005',
                    'position' => 'RT',
                    'nist_impression_type' => '0',
                    'value' => $this->faker->regexify('[A-Za-z0-9]{10}')
                ]
            ],
            'aes_key' => 'abcdefghijklmnop',
            'password' => 'abcdefghijklmnop',
            'ivkey' => 'abcdefghijklmnop', 
        ];
    }

    public function fingerPrintResponse() {
        return [
            'message' => 'OK',
            'data' => [
            'BVN' => $this->faker->regexify('[0-9]{10}'),
            'ResponseCode'  => '00',
            ]
        ];
    }

    public function singleRecordRequest() {
        return [
            'sandbox_key' => $this->sandbox_key,
            'organisation_code' => $this->organisation_code,
            'Record' => [
                'BVN' => $this->faker->regexify('[0-9]{10}'),
                'FirstName' => $this->faker->name(),
                'LastName' => $this->faker->name(),
                'MiddleName' => $this->faker->name(),
                'AccountNumber' => $this->faker->regexify('[0-9]{10}'),
                'BankCode' => '011'
            ],
            'aes_key' => 'abcdefghijklmnop',
            'password' => 'abcdefghijklmnop',
            'ivkey' => 'abcdefghijklmnop', 
        ];
    }

    public function singleRecordResponse() {
        return [
            'message' => 'OK',
            'data' => [
              'ResponseCode' => '00',
              'BVN' => 'VALID',
              'FirstName' => 'VALID',
              'LastName' => 'VALID',
              'MiddleName' => 'INVALID',
              'AccountNumber' => 'VALID',
              'BankCode' => 'VALID'
            ]
        ];
    }

    public function multipleRecordsRequest() {
        return [
            'sandbox_key' => $this->sandbox_key,
            'organisation_code' => $this->organisation_code,
            'Records' => [
                [
                    'BVN' => $this->faker->regexify('[0-9]{10}'),
                    'FirstName' => $this->faker->name(),
                    'LastName' => $this->faker->name(),
                    'MiddleName' => $this->faker->name(),
                    'AccountNumber' => $this->faker->regexify('[0-9]{10}'),
                    'BankCode' => '011'
                ],

                [
                    'BVN' => $this->faker->regexify('[0-9]{10}'),
                    'FirstName' => $this->faker->name(),
                    'LastName' => $this->faker->name(),
                    'MiddleName' => $this->faker->name(),
                    'AccountNumber' => $this->faker->regexify('[0-9]{10}'),
                    'BankCode' => '011'
                ],

            ],
            'aes_key' => 'abcdefghijklmnop',
            'password' => 'abcdefghijklmnop',
            'ivkey' => 'abcdefghijklmnop', 
        ];
    }

    public function multipleRecordsResponse() {
        return [
            'message' => 'OK',
            'data' => [
                'ValidationResponses' =>[
                    [
                        'ResponseCode' => '00',
                        'BVN' => 'VALID',
                        'FirstName' => 'VALID',
                        'LastName' => 'VALID',
                        'MiddleName' => 'INVALID',
                        'AccountNumber' => 'VALID',
                        'BankCode' => 'VALID'
                    ],
                    [
                        'ResponseCode' => '00',
                        'BVN' => 'VALID',
                        'FirstName' => 'VALID',
                        'LastName' => 'VALID',
                        'MiddleName' => 'INVALID',
                        'AccountNumber' => 'VALID',
                        'BankCode' => 'VALID'
                    ],
                ]
            ]
        ];
    }

}
