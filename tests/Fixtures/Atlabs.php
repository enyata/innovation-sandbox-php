<?php
require_once './vendor/autoload.php';

class Atlabs {
    private $faker, $organisation_code, $sandbox_key;
    
    public function __construct(){
        $this->faker = Faker\Factory::create();
        $this->sandbox_key = 'abcdefghijklmnop';
    }

    public function SendAirtimeRequest(){
        return [
            "host" => "hbvhjbh",
            "sandbox_key"=> $this->sandbox_key,
            "payload" => [
                "recipients" => [
                    [
                        "phoneNumber" => "+234".$this->faker->regexify('[0-9]{10}'),
                        "amount" => "1000",
                        "currencyCode" => "NGN"     
                    ]
                ]
            ]
        ];
    }

    public function SendAirtimeResponse(){
        return [
            "description" => "Success",
            "token" => "CkTkn_".$this->faker->regexify('[A-Za-z0-9]{36}')
        ];
    }

    public function KeyErrorResponse(){
        return [
            "error" => [
                "message" => "Unauthorized",
                "error_code" => 401,
                "error_message" => "UNAUTHORIZED",
                "data" => null
            ],
            "statusCode" => 401
        ];
    }

    public function InvalidKeyErrorResponse(){
        return [
            "error" => [
                "message" => "Invalid Sandbox Key",
                "error_code" => 403,
                "error_message" => "FORBIDDEN",
                "data" => null
            ],
            "statusCode" => 403
        ];
    }

    public function AirtimePayloadErrorResponse(){
        return [
            "error" => [
                "message" => "Bad Request",
                "error_code" => 400,
                "error_message" => "BAD_REQUEST",
                "data" => [
                    "recipients" => "is required"
                ]
            ],
            "statusCode" => 400
        ];
    }

    public function SMSServicePayloadErrorResponse(){
        return [
            "error" => [
                "message" => "Bad Request",
                "error_code" => 400,
                "error_message" => "BAD_REQUEST",
                "data" => [
                    "to" => "is required",
                    "from" => "is required",
                    "message" => "is required"
                ]
            ],
            "statusCode" => 400
        ];
    }

    public function InvalidSMSServiceSenderErrorResponse(){
        return [
            "error" => [
                "message" => "Bad Request",
                "error_code" => 400,
                "error_message" => "BAD_REQUEST",
                "data" => [
                    "to" => "is required",
                    "from" => "is required",
                    "message" => "is required"
                ]
            ],
            "statusCode" => 400
        ];
    }

    public function InvalidTokenErrorResponse(){
        return [
            "error" => [
                "status" => "Failed",
                "description" => 'Invalid token provided',
            ],
            "statusCode" => 400
        ];
    }

    public function CheckoutTokenRequest(){
        return [
            "host" => "hbvhjbh",
            "sandbox_key"=> $this->sandbox_key,
            "payload" => [
                "phoneNumber" => "+234".$this->faker->regexify('[0-9]{10}'),  
            ]
        ];
    }

    public function CheckoutTokenResponse(){
        return [
            "description" => "Success",
            "token" => "CkTkn_".$this->faker->regexify('[A-Za-z0-9]{36}')
        ];
    }


    public function SMSServiceRequest(){
        return [
            "host" => "hbvhjbh",
            "sandbox_key"=> $this->sandbox_key,
            "payload" => [
                "to" => "+234".$this->faker->regexify('[0-9]{10}'),
                "from" => "FSI",
                "message" => "Hello World"
            ]
        ];
    }

    public function SMSServiceResponse(){
        return [
                "SMSMessageData" => [
                    "Message" => "Sent to 1/1 Total Cost: NGN 2.2000",
                    "Recipients" => [
                        [
                            "statusCode" => 101,
                            "number" => "+234".$this->faker->regexify('[0-9]{10}'),
                            "cost" => "NGN 2.2000",
                            "status" => "Success",
                            "messageId" => "ATXid_".$this->faker->regexify('[A-Za-z0-9]{32}')
                        ]
                    ]
                ]
        ];
    }

    public function PremiumSMSRequest(){
        return [
            "host" => "hbvhjbh",
            "sandbox_key"=> $this->sandbox_key,
            "payload" => [
                "to" => "+234".$this->faker->regexify('[0-9]{10}'),
                "from" => "FSI",
                "message" => "Hello World",
                "linkId" => $this->faker->regexify('[0-9]{5}'),
                "retryDurationInHours" => "1"
            ]
        ];
    }

    public function PremiumSMSResponse(){
        return [
                "SMSMessageData" => [
                    "Message" => "Sent to 1/1",
                    "Recipients" => [
                        [
                            "statusCode" => 101,
                            "number" => "+234".$this->faker->regexify('[0-9]{10}'),
                            "cost" => "0",
                            "status" => "Success",
                            "messageId" => "ATXid_".$this->faker->regexify('[A-Za-z0-9]{32}')
                        ]
                    ]
                ]
        ];
    }

    public function CreatePremiumRequest(){
        return [
            "host" => "hbvhjbh",
            "sandbox_key"=> $this->sandbox_key,
            "payload" => [
                "phoneNumber" => "+234".$this->faker->regexify('[0-9]{10}'),
                "keyword" => "innovation-sandbox",
                "shortCode" => $this->faker->regexify('[0-9]{5}'),
                "checkoutToken" => "CkTkn_".$this->faker->regexify('[A-Za-z0-9]{36}')
            ]
        ];
    }

    public function CreatePremiumResponse(){
        return [
            "status" => "Success",
            "description" => "Waiting for user input"
        ];
    }

    public function DeletePremiumRequest(){
        return [
            "host" => "hbvhjbh",
            "sandbox_key"=> $this->sandbox_key,
            "payload" => [
                "phoneNumber" => "+234".$this->faker->regexify('[0-9]{10}'),
                "keyword" => "innovation-sandbox",
                "shortCode" => $this->faker->regexify('[0-9]{5}'),
            ]
        ];
    }

    public function DeletePremiumResponse(){
        return [
            "status" => "Success",
            "description" => "Succeeded"
        ];
    }

    public function FetchPremiumRequest(){
        return [
            "host" => "hbvhjbh",
            "sandbox_key"=> $this->sandbox_key,
            "payload" => [
                "keyword" => "innovation-sandbox",
                "shortCode" => $this->faker->regexify('[0-9]{5}'),
                "lastReceivedId" => "0"
            ]
        ];
    }

    public function FetchPremiumResponse(){
        return [
            "responses" => [],
        ];
    }

    public function FetchMessagesRequest(){
        return [
            "host" => "hbvhjbh",
            "sandbox_key"=> $this->sandbox_key,
            "payload" => [
                "lastReceivedId" => "0"
            ]
        ];
    }

    public function FetchMessagesResponse(){
        return [
            "SMSMessageData" => [
                "Messages" => []
            ],
        ];
    }

    public function InitiateVoiceCallRequest(){
        return [
            "host" => "hbvhjbh",
            "sandbox_key"=> $this->sandbox_key,
            "payload" => [
                "callTo" => "+234".$this->faker->regexify('[0-9]{10}'),
                "callFrom" => "FSI",
            ]
        ];
    }

    public function InitiateVoiceCallResponse(){
        return [
            "entries" => [],
            "errorMessage" => "Invalid callerId: +234".$this->faker->regexify('[0-9]{10}')
        ];
    }

    public function QueueStatusRequest(){
        return [
            "host" => "hbvhjbh",
            "sandbox_key"=> $this->sandbox_key,
            "payload" => [
                "phoneNumbers" => "+234".$this->faker->regexify('[0-9]{10}'),
            ]
        ];
    }

    public function QueueStatusResponse(){
        return [
            "status" => "Success",
            "errorMessage" => "None",
            "entries" => []
        ];
    }

    public function MediaUploadRequest(){
        return [
            "host" => "hbvhjbh",
            "sandbox_key"=> $this->sandbox_key,
            "payload" => [
                "phoneNumbers" => "+234".$this->faker->regexify('[0-9]{10}'),
                "url" => "someurl"
            ]
        ];
    }

    public function MediaUploadResponse(){
        return "The request has been fulfilled and resulted in a new resource being created.";
    }
}
