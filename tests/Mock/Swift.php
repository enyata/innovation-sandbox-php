<?php
require_once './vendor/autoload.php';

class Swift
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

    public function oauth2Request()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            "consumer_key" => "umNvx0EX2LelvDuoG4L4LMA0w2uKAApX",
            "consumer_secret" => "blOzfCw2tTtGU9xu",
            "payload" => [
                "username" => "01",
                "password" => "01",
                "grant_type" => "password"
            ]
        ];
    }

    public function oauth2Response()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                "refresh_token_expires_in" => '86399',
                "token_type" => 'Bearer',
                "access_token" => 'o3VaGWKuDyE9fWAP8uv0Vy09s0Tb',
                "refresh_token" => 'GosRkFVb8a06TiuMiCagSnjSmtsJy844',
                "idm_service" => 'KYC_API',
                "expires_in" => '1799'
            ]
        ];
    }


    public function EntityListRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            "access_token" => "o3VaGWKuDyE9fWAP8uv0Vy09s0Tb"
        ];
    }

    public function EntityListResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                "myEntity" => [
                    [
                        "legalName" => 'GLOBAL BANK BADEN-WUERTTEMBERG',
                        "bic" => 'GLOBDESTXXX'
                    ]
                ]
            ]
        ];
    }

    
    public function CounterPartyRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            "access_token" => "o3VaGWKuDyE9fWAP8uv0Vy09s0Tb"
        ];
    }

    public function CounterPartyResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                "myCounterparty" => [
                    [
                        "legalName" => 'LONGBRIDGE BANK N.A.',
                        "bic" => 'LONGAEADXXX'
                    ]
                ]
            ]
        ];
    }

    public function StatusRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            "access_token" => "o3VaGWKuDyE9fWAP8uv0Vy09s0Tb",
            "payment_id" => "123456tyty"
        ];
    }

    public function StatusResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                "Status" => 'OK'
            ]
        ];
    }

    public function TransactionsRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            "access_token" => "o3VaGWKuDyE9fWAP8uv0Vy09s0Tb",
            "payment_id" => "123456tyty"
        ];
    }

    public function TransactionsResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                "uetr" => '97ed4827-7b6f-4491-a06f-b548d5a7512d',
                "transaction_status" => 'ACCC',
                "initiation_time" => '2020-06-08T15 =>38 =>33.0Z',
                "completion_time" => '2020-06-08T19 =>56 =>31.0Z',
                "last_update_time" => '2020-06-08T19 =>56 =>31.0Z',
                "payment_event" => [
                    [
                        "network_reference" => '200608GRWLCNSHXXXA0815707108',
                        "message_name_identification" => '103',
                        "business_service" => '001',
                        "tracker_event_type" => 'CTPT',
                        "valid" => true,
                        "instruction_identification" => 'Payment1',
                        "transaction_status" => 'ACSP',
                        "transaction_status_reason" => 'G000',
                        "return" => false,
                        "settlement_method" => 'INGA',
                        "from" => 'GRWLCNSH',
                        "to" => 'BLKFDE33',
                        "serial_parties" => [
                            "debtor_agent" => 'GRWLCNSH',
                            "creditor_agent" => 'BWWLPLPW'
                        ],
                        "sender_acknowledgement_receipt" => '2020-06-08T15 =>38 =>33.0Z',
                        "received_date" => '2020-06-08T15 =>38 =>33.0Z',
                        "instructed_amount" => [
                            "currency" => 'EUR',
                            "amount" => '22000.00'
                        ],
                        "interbank_settlement_amount" => [
                            "currency" => 'EUR',
                            "amount" => '21978.00'
                        ],
                        "interbank_settlement_date" => '2020-06-08',
                        "charge_bearer" => 'CRED',
                        "charge_amount" => [
                            [
                                "currency" => 'EUR',
                                "amount" => '22.00'
                            ]
                        ],
                        "last_update_time" => '2020-06-08T15 =>38 =>33.0Z'
                    ]
                ]
            ]
        ];
    }

    public function CancellationRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            "access_token" => "o3VaGWKuDyE9fWAP8uv0Vy09s0Tb",
            "payment_id" => "123456tyty",
            "payload" => [
                "rom" => 'BANABEBBXXX',
                "business_service" => '002',
                "case_identification" => '123',
                "cancellation_reason_information" => 'DUPL'
            ]
        ];
    }

    public function CancellationResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                "Status" => 'OK'
            ]
        ];
    }

    public function CorperateTransactionsRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            "access_token" => "o3VaGWKuDyE9fWAP8uv0Vy09s0Tb",
            "x-bic" => "1234567890",
            "client" => "cclabeb0"
        ];
    }

    public function CorperateTransactionsResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                "payment_transaction" => [
                    [
                        "uetr" => '54806732-bfb8-43e0-9a42-44f46ca3f700',
                        "transaction_status" => 'ACCC',
                        "transaction_status_reason" => null,
                        "event_time" => '2018-05-09T15 =>23 =>10.000Z',
                        "originator" => 'BANCDEFFXXX',
                        "instructed_amount" => [
                            "currency" => 'GBP',
                            "amount" => '900'
                        ],
                        "confirmed_amount" => [
                            "currency" => 'GBP',
                            "amount" => '885'
                        ],
                        "interbank_settlement_date" => null,
                        "payment_event" => [
                            [
                                "from" => 'BANABEBB',
                                "to" => 'BANBUS33',
                                "charge_bearer" => 'SHAR',
                                "charge_amount" => [
                                    "currency" => 'GBP',
                                    "amount" => '0'
                                ],
                                "foreign_exchange_details" => null,
                                "date_time" => null
                            ]
                        ]
                    ]
                ],
                "next" => 'dXNlIHRoaXMgdmFsdWUgdG8gcmVxdWVzdCBuZXh0IHNldCBvZiBkYXRh'
            ]
        ];
    }

    public function InboundRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            "access_token" => "o3VaGWKuDyE9fWAP8uv0Vy09s0Tb",
            "x-bic" => "1234567890",
            "client" =>"cclabeb0",
            "params" => [
              "status" => "ACCC"  
            ]
        ];
    }

    public function InboundResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                "payment_transaction" => [
                       [ 
                            "uetr" => '97ed4827-7b6f-4491-a06f-b548d5a7512d',
                            "transaction_status" => null,
                            "transaction_status_reason" => null,
                            "event_time" => null,
                            "originator" => null,
                            "instructed_amount" => null,
                            "confirmed_amount" => null,
                            "interbank_settlement_date" => null,
                            "payment_event" => []
                       ]
                ],
                "next" => null
            ]
        ];
    }

  
    public function verificationRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            "LAUApplicationID" => '001',
            "LAUCallTime" => '2018-03-23T15:56:26.728Z',
            "LAURequestNonce" => 'e802ab96-bb3a-4965-9139-5214b9f0f074',
            "LAUVersion" => '1.0',
            'x-api-key' => 'umNvx0EX2LelvDuoG4L4LMA0w2uKAApX',
            "LAUSignature" => 'U1khA8h9Lm1PqzB99fG6uw==',
            "LAUSigned" => "(ApplAPIKey=umNvx0EX2LelvDuoG4L4LMA0w2uKAApX),(x-bic=1234567890)",
            "payload" => [
                "correlation_identifier" => 'SCENARIO1-CORRID-002',
                "context" => 'BENR',
                "uetr" => 'b916a97d-a699-4f20-b8c2-2b07e2684a27',
                "creditor_account" => 'GB3112000000001987426375',
                "creditor_name" => 'John Doe',
                "creditor_address" => ["country" => 'GB' ],
                "creditor_organisation_identification" => [ "any_bic" => 'BANABEBB' ]
            ]
        ];
    }

    public function verificationResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                "correlation_identifier" => 'SCENARIO1-CORRID-002',
                "response" => [
                    "account_validation_status" => 'FAIL',
                    "creditor_account_match" => 'NMTC',
                    "creditor_name_match" => 'NOAP',
                    "creditor_address_match" => 'NOAP',
                    "creditor_organisation_identification_match" => 'NOAP'
                ]
            ]
        ];
    }
}
