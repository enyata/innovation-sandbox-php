<?php
require_once './vendor/autoload.php';

class RelianceHMO
{
    private $faker;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
    }

    public function InvalidKeyRequest()
    {
        return [
            'sandbox_key' => 'some_key'
        ];
    }

    public function InvalidKeyResponse()
    {
        return [
            'error' => 'Expired/Invalid Sandbox Key.',
            'statusCode' => 403
        ];
    }

    public function NoKeyRequest()
    {
        return [
            'sandbox_key' => ''
        ];
    }

    public function NoKeyResponse()
    {
        return [
            'error' => 'Unauthorized. Please check your credentials.',
            'statusCode' => 401
        ];
    }

    public function WrongPayloadResponse()
    {
        return [
            'error' => [
                'ResponseCode' => '05',
                'Message' => 'Unmatched Request, Refer to documentation.'
            ],
            'statusCode' => 400
        ];
    }

    public function ClientSignupRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'payload'  => [
                'transfer_code' => '1234WXYZ',
                'company_name' => 'Justice League',
                'company_address' => '85, outer space',
                'state_code' => 'NG-LA',
                'payment_frequency' => 'monthly',
                'company_admin' => [
                    'first_name' => 'Bruce',
                    'last_name' => 'Wayne',
                    'email_address' => 'bruce@wayne.corp',
                    'phone_number' => '08011122234'
                ],
                'enrollees' => [
                    [
                        'plan_id' => 22,
                        'first_name' => 'Bruce',
                        'last_name' => 'Wayne',
                        'email_address' => 'bruce@wayne.corp',
                        'phone_number' => '08011122234'
                    ],
                    [
                        'plan_id' => 14,
                        'first_name' => 'Barry',
                        'last_name' => 'Allen',
                        'email_address' => 'barry@flash.org',
                        'phone_number' => '08033344322'
                    ]
                ]
            ]
        ];
    }

    public function ClientSignupResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }

    public function RenewClientSubscriptionRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'id' => 'code1',
            'payload'  => [
                'transfer_code' => '1234WXYZ',
                'add' => [
                    [
                        'plan_id' => 22,
                        'firstname' => 'Princess',
                        'lastname' => 'Diana',
                        'email' => 'diana@amazon.com',
                        'phone_number' => '08041122234'
                    ]
                ],
                'remove' => ['K2JhMYr5wDGMxZWdh', 'z44JhMYyDGMxZ362hwe'],
                'update' => [
                    [
                        'plan_id' => 24,
                        'user_token' => 'Y2JhMWJhNDc4YWJkMGMxZWdh'
                    ]
                ]
            ]
        ];
    }

    public function RenewClientSubscriptionResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }

    public function ConsultationsRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'params'  => [
                'patient_id' => 232,
                'reason' => 'reason for consultation'
            ]
        ];
    }

    public function ConsultationsResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }

    public function EnrolleeRegistrationRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'payload'  => [
                'enrollees' =>  [
                    [
                        'payment_frequency' =>  'monthly',
                        'first_name' =>  'John',
                        'last_name' =>  'Doe',
                        'email_address' =>  'dewo.1@kang.pe',
                        'phone_number' =>  '08132846940',
                        'plan_id' =>  22,
                        'can_complete_profile' =>  'true',
                        'profile' =>  [
                            'sex' =>  'm',
                            'date_of_birth' =>  '1991-03-03',
                            'first_name' =>  'Doey',
                            'last_name' =>  'Doe',
                            'primary_phone_number' =>  '08159049122',
                            'home_address' =>  'Somewhere Awesome',
                            'has_smartphone' =>  'true',
                            'profile_picture_filename' =>  'ttffddzp.jpg',
                            'enrollee_type' =>  1,
                            'hmo_id' =>  ''
                        ],
                        'dependants' =>  [
                            [
                                'first_name' =>  'Janet',
                                'last_name' =>  'Dependant',
                                'email_address' =>  'wu1uo389@gmail.com',
                                'phone_number' =>  '08132046940',
                                'plan_id' =>  22
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    public function EnrolleeRegistrationResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }

    public function GetEnrolleesRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'params'  => [
                'page' => 1,
                'limit' => 10
            ]
        ];
    }

    public function GetEnrolleesResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }

    public function GetEnrolleeRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'id' => 'enrollee44'
        ];
    }

    public function GetEnrolleeResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }

    public function EnrolleeProfileRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'params'  => [
                'sex' => 'f',
                'date_of_birth' => '1991-03-03',
                'home_address' => '85, outer space',
                'has_smartphone' => true,
                'profile_picture_filename' => 'ttffddzp.png',
                'hash' => 'ZDZhMTlYxRkQ0ODRDNisrMzQ'
            ]
        ];
    }

    public function EnrolleeProfileResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }

    public function ValidateEnrolleeRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'params'  => [
                'hmo_id' => 'TXT/10002/A'
            ]
        ];
    }

    public function ValidateEnrolleeResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }

    public function EnrolleeCardRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'params'  => [
                'hmo_id' => 'TXT/10002/A'
            ]
        ];
    }

    public function EnrolleeCardResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }

    public function PlansRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'params'  => [
                'type' => 'family',
                'package' => 'retail'
            ]
        ];
    }

    public function PlansResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }

    public function RetailSignupRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'payload'  => [
                'Referral_code' => '1122345',
                'enrollees' => [
                    [
                        'payment_frequency' => 'monthly',
                        'first_name' => 'John',
                        'last_name' => 'Doe',
                        'email_address' => 'testuser1@kang.pe',
                        'phone_number' => '08132646940',
                        'plan_id' => 22,
                        'can_complete_profile' => true,
                        'dependants' => [
                            [
                                'first_name' => 'Janet',
                                'last_name' => 'Dependant',
                                'email_address' => 'testuser2@kang.pe',
                                'phone_number' => '08132646940',
                                'plan_id' => 22
                            ],
                            [
                                'first_name' => 'Fred',
                                'last_name' => 'Dependant',
                                'email_address' => 'testuser3@kang.pe',
                                'phone_number' => '08132646940',
                                'plan_id' => 24
                            ]
                        ]
                    ],
                    [
                        'payment_frequency' => 'q',
                        'first_name' => 'Ben',
                        'last_name' => 'Stiller',
                        'email_address' => 'snr22325@awsoo.com',
                        'phone_number' => '08132646940',
                        'plan_id' => 24,
                        'can_complete_profile' => false,
                        'dependants' => []
                    ]
                ]
            ]
        ];
    }

    public function RetailSignupResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }

    public function RenewRetailSubscriptionRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'payload'  => [
                'enrollees' => [
                    [
                        'user_id' => 345,
                        'remove' => [347]
                    ]
                ]
            ]
        ];
    }

    public function RenewRetailSubscriptionResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }

    public function ProvidersRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'params'  => [
                'state' =>  'NG-LA',
                'plan_id' =>  '25',
                'tiers' =>  '1,2',
                'page' =>  1,
                'limit' =>  50
            ]
        ];
    }

    public function ProvidersResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }

    public function StatesRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop'
        ];
    }

    public function StatesResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }

    public function BenefitsRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'params' => [
                'plan' => 25
            ]
        ];
    }

    public function BenefitsResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }

    public function TitlesRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop'
        ];
    }

    public function TitlesResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }

    public function OccupationsRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop'
        ];
    }

    public function OccupationsResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }

    public function MaritalStatusesRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop'
        ];
    }

    public function MaritalStatusesResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }

    public function WalletBalanceRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop'
        ];
    }

    public function WalletBalanceResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }

    public function FundWalletRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'payload' => [
                'amount' => '250000'
            ]
        ];
    }

    public function FundWalletResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }

    public function WalletTransactionsRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop'
        ];
    }

    public function WalletTransactionsResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'status' => 'success'
            ]
        ];
    }
}
