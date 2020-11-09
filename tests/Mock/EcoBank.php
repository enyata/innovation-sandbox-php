<?php
require_once "./vendor/autoload.php";

class EcoBank
{
    private $faker;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
    }

    public function InvalidKeyRequest()
    {
        return [
            "sandbox_key" => "some_key"
        ];
    }

    public function InvalidKeyResponse()
    {
        return [
            "error" => "Expired/Invalid Sandbox Key.",
            "statusCode" => 403
        ];
    }

    public function NoKeyRequest()
    {
        return [
            "sandbox_key" => ""
        ];
    }

    public function NoKeyResponse()
    {
        return [
            "error" => "Unauthorized. Please check your credentials.",
            "statusCode" => 401
        ];
    }

    public function WrongPayloadResponse()
    {
        return [
            "error" => [
                "ResponseCode" => "05",
                "Message" => "Unmatched Request, Refer to documentation."
            ],
            "statusCode" => 400
        ];
    }

    public function AirtimeBillersRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            "payload" => [
                header => [
                    "affcode" => "EGH",
                    "requestId" => "123456",
                    "requestToken" => "ab104d4f4fbff91be354a49f26ab8991610c4174233447ef4101f61f09879371e0b8d2ae8eb3edabe45cb30be88ec2390deeeab6607bbbd8faa5b7c0fb82a35b",
                    "sourceCode" => "TEST",
                    "sourceIp" => "1.2.3.4",
                    "channel" => "MOBILE",
                    "requesttype" => "VALIDATE",
                    "agentcode" => "50420442"
                ]
            ]
        ];
    }

    public function AirtimeBillersResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "airtimebillers" => [
                    [
                        "billercode" => "Glo TOPUP",
                        "billername" => "GLO",
                        "category" => "GLO",
                        "serialNo" => 1
                    ],
                    [
                        "billercode" => "Etisalat TOPUP",
                        "billername" => "9Mobile",
                        "category" => "9Mobile",
                        "serialNo" => 2
                    ],
                    [
                        "billercode" => "Airtel TOPUP",
                        "billername" => "Airtel",
                        "category" => "Airtel",
                        "serialNo" => 3
                    ],
                    [
                        "billercode" => "MTN_NG",
                        "billername" => "MTN",
                        "category" => "MTN",
                        "serialNo" => 4
                    ]
                    ],
                    "Server" => "Cowboy",
                    "requestId" => $this->faker->regexify("[A-Za-z0-9]{16}"),
                    "responsecode" => "000",
                    "responsemessage" => "SUCCESS",
            ]
        ];
    }

    public function BuyAirtimeRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            "payload" => [
                "billercode" => "MTN GHANA",
                "mobileno" => "0246108878",
                "amount" => "20",
                "transactiontoken" => "488bdead4dae96d90a6b170992d8335cf56e8baa1ce0887ab72f917b86668f7477331b8f8e1702a576d9cf58aa9cc2505c3d31fac93cd5c6806fd2efe9316634",
                "ccy" => "GHC",
                "header" => [
                    "affcode" => "EGH",
                    "requestId" => "123456",
                    "requestToken" => "ab104d4f4fbff91be354a49f26ab8991610c4174233447ef4101f61f09879371e0b8d2ae8eb3edabe45cb30be88ec2390deeeab6607bbbd8faa5b7c0fb82a35b",
                    "sourceCode" => "TEST",
                    "sourceIp" => "1.2.3.4",
                    "channel" => "MOBILE",
                    "requesttype" => "VALIDATE",
                    "agentcode" => "50420442"
                ]
            ]
        ];
    }

    public function BuyAirtimeResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "myEntity" => [
                    [
                        "cbareferenceno" => "A190320093921731",
                        "externalrefno" => "A190320093921731"
                    ]
                    ],
                    "Server" => "Cowboy",
                    "requestId" => $this->faker->regexify("[A-Za-z0-9]{16}"),
                    "responsecode" => "000",
                    "responsemessage" => "SUCCESS",
            ]
        ];
    }
    
    public function AgencyBalanceRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            "payload" => [
                "header" => [
                    "affcode" => "ENG",
                    "requestId" => "A190320093921731",
                    "requestToken" => "f5b6003ebd6a25e8e837ff7fca4a7ee42f22f0f3b8313c5a9e6ac4cb0f250c55e30111a330c6fc46a1067176b3c4baea2f6317ce99af5e2a39d11125552e6bdb",
                    "sourceCode" => "KAZANG",
                    "sourceIp" => "10.8.245.9",
                    "channel" => "API",
                    "requesttype" => "VALIDATE",
                    "agentcode" => "20209387"
                ],
                "transactiontoken" => "dfd9f14d926b54c2bf06b197969624a575e84727e67fbeea6746788b05e7afa838e0d60c48fb5d9825cbece019ef52f57853dbad543bf233e4d43a5cf2a5e74e"
            ]
        ];
    }

    public function AgencyBalanceResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                [
                    "ccy" => 'NGN',
                    "commAccountBalance" => 3247.25,
                    "commAccountNo" => '2151106841',
                    "servicename" => 'Agent to Agent',
                    "tradingAccountBalance" => 7837519.97,
                    "tradingAccountNo" => '0011001594'
                ],
            ]
        ];
    }

    public function CustomerDetailsRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            "access_token" => "o3VaGWKuDyE9fWAP8uv0Vy09s0Tb",
            "payload" => [
                "accountno" => '0011002948',
                "header" => [
                    "affcode" => 'EGH',
                    "requestId" => 'A190320093921736',
                    "requestToken" => 'b3ea5445f84d8464c4e03b43f994e7ee36655144622f22b296ec7b47979460b91ad059199b4b5dcc1d9851e3a04edd9d250119ee295b7b69ef709c791e779bb6',
                    "sourceCode" => 'KAZANG',
                    "sourceIp" => '10.8.245.9',
                    "channel" => 'MOBILE',
                    "requesttype" => 'VALIDATE',
                    "agentcode" => '20209387'
                ]
            ]
        ];
    }

    public function CustomerDetailsResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "header" => [
                    "requestId" => 'A190320093921731',
                    "responsecode" => '000',
                    "responsemessage" => 'SUCCESS'
                ],
                "customername" => "Nana Pun"
            ]
        ];
    }

    public function GenerateTokenRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            "payload" => [
                "userId" => "o3VaGWKuDyE9fWAP8uv0Vy09s0Tb",
                "password" => "o3VaGWKuDyE9fWAP8uv0Vy09s0Tb"
            ]
        ];
    }

    public function GenerateTokenResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "username" => "o3VaGWKuDyE9fWAP8uv0Vy09s0Tb",
                "token" => "o3VaGWKuDyE9fWAP8uv0Vy09s0Tb"
            ]
        ];
    }

    public function CardPaymentRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            "access_token" => "o3VaGWKuDyE9fWAP8uv0Vy09s0Tb",
            "payload" => [
                "paymentDetails" => [
                    "requestId" => "4466",
                    "productCode" => "GMT112",
                    "amount" => "50035",
                    "currency" => "GBP",
                    "locale" => "en_AU",
                    "orderInfo" => "255s353",
                    "returnUrl" => "https =>//unifiedcallbacks.com/corporateclbkservice/callback/qr"
                ],
                "merchantDetails" => [
                    "accessCode" => "79742570",
                    "merchantID" => "ETZ001",
                    "secureSecret" => "sdsffd"
                ],
                "LabKey" => "255s353"
            ]
        ];
    }

    public function CardPaymentResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "response_code" => 200,
                "response_message" => 'success',
                "response_content" => 'https://migs-mtf.mastercard.com.au/vpcpay?vpc_AccessCode=79742570&vpc_Amount=50035&vpc_Version=1&vpc_MerchTxnRef=4466&vpc_OrderInfo=255s353&vpc_Command=pay&vpc_Currency=GBP&vpc_Merchant=ETZ001&vpc_Locale=en_AU&vpc_ReturnURL=https%3A%2F%2Funifiedcallbacks.com%2Fcorporateclbkservice%2Fcallback%2Fqr&vpc_SecureHash=D425374E5B303A7DE48938253EDAA3CE26B49C8BD0D6FF32592ED445F5FB5ECF&vpc_SecureHashType=SHA256'
            ]
        ];
    }

    public function MomoPaymentRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            "access_token" => "o3VaGWKuDyE9fWAP8uv0Vy09s0Tb",
            "payload" => [
                "affiliateCode" => 'EGH',
                "telco" => 'MTN',
                "channel" => 'UNIFIED',
                "token" => 'SBRC/3MJMGmz1WuHiRpmikk6SWgBj/Tt',
                "content" => [
                    "countryCode" => 'GH',
                    "transId" => '1ER9P00OT',
                    "productCode" => '1132',
                    "senderName" => 'ben',
                    "senderAccountNo" => '233242006671',
                    "senderPhoneNumber" => '233242006671',
                    "branch" => '001',
                    "transRef" => 'REF671700057',
                    "bankref" => 'REF6798238',
                    "receiverPhoneNumber" => '0244296442',
                    "receiverFirstName" => 'Kojo',
                    "receiverLastName" => 'Funds',
                    "receiverEmail" => '',
                    "receiverBank" => '6762482201037786',
                    "currency" => 'GHS',
                    "amount" => '0.01',
                    "transDesc" => 'Wallet Trans',
                    "transType" => 'pull'
                ],
                "LabKey" => "255s353"
            ]
        ];
    }

    public function MomoPaymentResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "response_code" => 200,
                "response_message" => 'success',
                "response_content" => [
                    "responseCode" => '0000',
                    "transactionRef" => 'MMOMODR1910259929503',
                    "responseMessage" => 'Transaction accepted'
                ]
            ]
        ];
    }

    public function MCCRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            "access_token" => "o3VaGWKuDyE9fWAP8uv0Vy09s0Tb",
            "payload" => [
                "requestId" => '123344',
                "affiliateCode" => 'EGH',
                "requestToken" => '/4mZF42iofzo7BDu0YtbwY6swLwk46Z91xItybhYwQGFpaZNOpsznL/9fca5LkeV',
                "sourceCode" => 'ECOBANK_QR_API',
                "sourceChannelId" => 'KANZAN',
                "requestType" => 'CREATE_MERCHANT'
            ]
        ];
    }

    public function MCCResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "headerRequest" => [
                    "requestId" => '123344',
                    "affiliateCode" => 'EGH',
                    "requestToken" => '/4mZF42iofzo7BDu0YtbwY6swLwk46Z91xItybhYwQGFpaZNOpsznL/9fca5LkeV',
                    "sourceCode" => 'ECOBANK_QR_API',
                    "sourceChannelId" => 'KANZAN',
                    "requestType" => 'CREATE_MERCHANT'
                ],
                "mcc" => [
                    [
                        "mcc" => '3354',
                        "mccName" => 'Action Auto Rental'
                    ]
                ]
            ]
        ];
    }
  
    public function CreateQRRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            "access_token" => "o3VaGWKuDyE9fWAP8uv0Vy09s0Tb",
            "payload" => [

                        "headerRequest" => [
                            "requestId" => '',
                            "affiliateCode" => 'EGH',
                            "requestToken" => '/4mZF42iofzo7BDu0YtbwY6swLwk46Z91xItybhYwQGFpaZNOpsznL/9fca5LkeV',
                            "sourceCode" => 'ECOBANK_QR_API',
                            "sourceChannelId" => 'KANZAN',
                            "requestType" => 'CREATE_MERCHANT'
                        ],
                        "merchantAddress" => '123ERT',
                        "merchantName" => 'UNIFIED SHOPPING CENTER',
                        "accountNumber" => '02002233444',
                        "terminalName" => 'UNIFIED KIDS SHOPPING ARCADE',
                        "mobileNumber" => '0245293945',
                        "email" => 'freemanst@gmail.com',
                        "area" => 'Ridge',
                        "city" => 'Ridge',
                        "referralCode" => '123456',
                        "mcc" => '0000',
                        "dynamicQr" => 'Y',
                        "callBackUrl" => 'http://koala.php',
                        "LabKey" => "255s353"
            ]
        
    ];
    }

    public function CreateQRResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "response_code" =>  200,
                "response_message" =>  'success',
                "response_content" =>  [
                    "headerResponse" =>  [
                        "affiliateCode" =>  'EGH',
                        "requestId" =>  '',
                        "responseCode" =>  '000',
                        "responseMessage" =>  'Success',
                        "sourceCode" =>  'ECOBANK_QR_API'
                    ],
                    "merchantCode" =>  '603043343',
                    "qrCodeBase64" =>  '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',
                    "terminalId" =>  '32631648',
                    "terminalName" =>  'UNIFIED KIDS SHOPPING ARCADE',
                    "secretKey" =>  'JG)kVCFPy*'
                ],
                "response_timestamp" =>  '2019-11-15T09:35:06.045'
            ]
        ];
    }

    public function QRRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            "access_token" => "o3VaGWKuDyE9fWAP8uv0Vy09s0Tb",
            "payload" => [
                "ec_terminal_id" => '20207038',
                "ec_transaction_id" => 'we2209',
                "ec_amount" => 200,
                "ec_charges" => '0',
                "ec_fees_type" => 'P',
                "ec_ccy" => 'KES',
                "ec_payment_method" => 'QR',
                "ec_customer_id" => 'OK1337/09',
                "ec_customer_name" => 'DAVID AMUQUANDOH',
                "ec_mobile_no" => '233260516997',
                "ec_email" => 'DAVYTHIT@GMAIL.COM',
                "ec_payment_description" => 'PAYMENT FOR JUMIA SHOPPING',
                "ec_product_code" => 'AEW23FSSS',
                "ec_product_name" => 'ONLINE SHOPPING 1212',
                "ec_transaction_date" => 'bnbbn',
                "ec_affiliate" => 'qwe123QE',
                "ec_country_code" => '123',
                "LabKey" => "255s353"
            ]
        
        ];
    }

    public function QRResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "response_code" => 200,
                "response_error" => '',
                "response_status" => 'success',
                "response_content" => [
                    "dynamicQRBase64" => 'iVBORw0KGgoAAAANSUhEUgAAASwAAAEsCAYAAAB5fY51AAAI2ElEQVR42u3dUa7bOBREQe9/08kWAoTi7b6sA8yfXmxLZGkAQuLvjySV9HMKJAFLkoAlCViSBCxJApYkYEkSsCQJWJKAJUnAkiRgSQKWJAFLkoAlCViSBCxJApYkYEkSsCQJWJKAJUnAkiRgSQKWJAFLkoAlCViSBCxJwJIkYEkSsCQBS5KAJUnAkgQsSQLWP3+p3y/mv9O/439+7+nPmLpGjeMqaRykj3tgAQtYwAIWsIAFLGABC1jAAhawgAUsYAELWAVgJX3ulgGT9Lmnz1US5FvGPbCABSxgAQtYwAIWsIAFLGABC1jAAhawgAWs5WBNDfIbE/PGuUrHaQrAqTG0ZdwDC1jAAhawgAUsYAELWMACFrCABSxgAQtYwALWJ5/r/GUBfeMaJY0/YAELWMACFrCABSxgAQtYwAIWsIAFLGABC1jAqr1w6Y/1pK/CnT7Pm68RsIBlMgALWMACFrCABSxgAQtYwAIWsIAFLGAB6xOwkqC8sWLUiF36b0sak96HBSxgAQtYwAIWsIAFLGABC1jAAhawgAUsYAHr2glsnMCOc9wXNzg7PwMLWI4DFrCA5TjHAQtYwHIcsIAFLBPJccAC1vqSVg5v3BiSVqWmQLhxjQQsYAELWMACFrCABSxgAQtYwBKwgAUsYAHrk8mfNNjS30GVPtHT34eVNDamjgMWsIAFLGABC1jAAhawgAUsYAELWMACFrCAtXyVsHHSJL3fKP1xk6nflrRBSfrYABawgAUsYAELWMACFrCABSxgAQtYwAIWsIC1HKypAZ2+OULj+5c27+J9+txvhAhYwAIWsIAFLGABC1jAAhawgAUsYAELWMAC1kKcbqzwJO0gnP6Yy9R4aUQHWMACFrCABSxgAQtYwAIWsIAFLGABC1jAAhawPpmYjY9pNG7KcPrf24Js0o0QWMACFrCABSxgAQtYwAIWsIAFLGABC1jAAhawRjG5MVC3TJAbSEyBtQUTYAELWMACFrCABSxgAQtYwAIWsIAFLGABC1jAGh28U4MofVJPbUyR/t6xqWu+ZUMMYAELWMACFrCABSxgAQtYwAIWsIAFLGABC1iLcDr9t1OreumDN31FNf1xohtjw87PwAIWsIAFLGABC1jAAhawgAUsYAELWMAC1oNgNQ7o9MExhfFrQN/AfeNjOMACFrCABSxgAQtYwAIWsIAFLGABC1jAAhawLgMzNbBuTLgtxzWe+/S/TbrRAAtYwAIWsIAFLGABC1jAAhawgAUsYAELWMAqAGtq8Dau4N24MSTtBp2EU9KO2FNjCFjAAhawgAUsYAELWMACFrCABSxgAQtYwAJWKVivPSKT/s6jpPOcBEfSe9GABSxgAQtYwAIWsIAFLGABC1jAAhawgAUsYAErblA2rtw07tTcCGX6+AMWsIAFLGABC1jAAhawgAUsYAELWMACFrCABaxPJvrmnYYbV5vSN2qY+n5JN29gAQtYwAIWsIAFLGABC1jAAhawgAUsYAELWIvAatyAoXHFLQmEJKCnbpjpj2MBC1jAAhawgAUsYAELWMACFrCABSxgAQtYwCoFawrA9H9vy2MujatmW3a6bkcMWMACFrCABSxgAQtYwAIWsIAFLGABC1jAAtaH6DTuPvzad0lCNumRoPTVYmABC1jAAhawgAUsYAELWMACFrCABSxgAQtYVglHV2mSNgvYvOp4A44b3znpJu99WMACFrCABSxgAQtYwAIWsIAFLGABC1jAAtZysJLev3T639vyuVvwnLoRJr3HrOp/PoAFLGABC1jAAhawgAUsYAELWMACFrCABSxg3V3dmHokY8sqYdL1nULxtfEHLGABC1jAAhawgAUsYAELWMACFrCABSxgAcsqYcUqYfrqVdJmBpsfkUm6oQMLWMACFrCABSxgAQtYwAIWsIAFLGABC1jAAlbFhJsagDfO1ZaJNAXvFLLehwUsYAELWMACFrCABSxgAQtYwAIWsIAFLGABaxS7KRCSBvTpz5iaSFtWE7fclIEFLGABC1jAAhawgAUsYAELWMACFrCABSxgFaAzNdis3MzdGE5/xpaNQl5BDFjAAhawgAUsYAELWMACFrCABSxgAQtYwALWwom0ZZfipAmc9LdTN6nT4zlp/AELWMACFrCABSxgAQtYwAIWsIAFLGABC1jAKoBoajOIpM0qklaR0le+tly3G/MIWMACFrCABSxgAQtYwAIWsIAFLGABC1jAAtZysE5fpKkB3Xheks5p4w7bxiSwgAUsYAELWMACFrCABSxgAcuYBJbBASxgAaticiU9NpO0ocON35b0KEgSTlO7S0+dF2ABC1jAAhawgAUsYAELWMACFrCABSxgAQtYBWAlPbqRvto0hWzju8PS381lYwpgAQtYwAIWsIAFLGABC1jAAhawgAUsYAELWE82tdNw+rugGtFJ+n43bkjAAhawgAUsYAELWMACFrCABSxgAQtYwAIWsB4Eq3Hyp8PRiGLS+7AaH+/yaA6wgAUsYAELWMACFrCABSxgAQtYwAIWsIAFrNETnf6eps3nJQnjLe//2rgxBbCABSxgAcvEBBawgAUsYAELWMACFrCABSxgBVyQpBW8xom0+TvfQLbxES1gAQtYwAIWsIAFLGABC1jAAhawgAUsYAELWMCqfWdU487ASQM/6fem70LdHrCABSxgAQtYwAIWsIAFLGABC1jAAhawgAWsR8C68f1Of0bj5gjpG0403ghtQgEsYAELWMACFrCABSxgAQtYwAIWsIAFLGABq2K1qfG4dNg2/47T38UqIbCABSxgAQtYwPI7gAUsYAELWMACFrCABSxg/fcATNr52epQ50pu+jh9GTFgAQtYwAIWsIAFLGABC1jAAhawgAUsYAELWJIELEnAkiRgSRKwJAFLkoAlScCSBCxJApYkAUsSsCQJWJIELEnAkiRgSRKwJAFLkoAlScCSBCxJApYkAUsSsCQJWJKA5RRIApYkAUsSsCQJWJIELEnAkiRgSRKwJAFLkoAlScCSBCxJSugvOU+u/Fp1rqQAAAAASUVORK5CYII=',
                    "dynamicQR" => '00020101021202134729202421897041553263210106426952045416530340454032005802KE5912IPAY LIMITED6007NAIROBI62250308725288450509ECDYwe009630488BF',
                    "successURL" => 'https =>//dev-ci-pda.gutotal.com/pda/masterpass/api/call-callback',
                    "failedURL" => 'http =>//demo.albouritech.com/ecopaydemo/callback',
                    "responseCode" => '000',
                    "responseMessage" => 'Success',
                    "transactionAmount" => '200',
                    "transactionDescription" => 'PAYMENT FOR JUMIA SHOPPING'
                ],
                "response_info" => 'Request was successful',
                "response_time" => '25-10-2019 13:33:39'
            ]
        ];
    }

    public function StatementRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            "access_token" => "o3VaGWKuDyE9fWAP8uv0Vy09s0Tb",
            "payload" => [
                "affiliateCode" => 'EGH',
                "corporateId" => 'UNIFIED',
                "accountNumber" => '1441000820520',
                "startDate" => '20190826',
                "endDate" => '20191130',
                "labKey" => "255s353"
            ]
        
    ];
    }

    public function StatementResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "response_code" => 200,
                "response_message" => 'success',
                "response_content" => [
                    [
                        "narrative" => 'MOBILE TRANSFER BD1441000820520-SA Xpress Account DT0209',
                        "trn_REF_NO" => 'H75ZEXA1923800E0',
                        "value_DATE" => '2019-09-02 00 =>00 =>00.0',
                        "ac_CCY" => 'GHS',
                        "drcr_IND" => 'CR',
                        "lcy_AMOUNT1" => '10',
                        "paid_OUT" => null,
                        "paid_IN" => '10'
                    ]
                ],
                "response_timestamp" => '2019-11-15T22:08:16.541'
            ]
        ];
    }

    public function PaymentRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            "access_token" => "o3VaGWKuDyE9fWAP8uv0Vy09s0Tb",
            "payload" => [
                "paymentHeader"=> [
                    "clientid"=> 'EGHTelc000043',
                    "batchsequence"=> '1',
                    "batchamount"=> 170,
                    "transactionamount"=> 170,
                    "batchid"=> 'EG1593490',
                    "transactioncount"=> 7,
                    "batchcount"=> 7,
                    "transactionid"=> 'E12T443308',
                    "debittype"=> 'Multiple',
                    "affiliateCode"=> 'EGH',
                    "totalbatches"=> '1',
                    "execution_date"=> '2020-06-01 00:00:00'
                ],
                "extension" => [
                    [
                        "request_id" => '555555',
                        "request_type" => 'BILLPAYMENT',
                        "param_list" => [
                            [
                                "key" => 'billerCode',
                                "value" => 'CMACGM'
                            ]
                        ],
                        "amount" => 10,
                        "currency" => 'GHS',
                        "status" => '',
                        "rate_type" => 'spot'
                    ]
                ],
                "labKey" => "255s353"
            ]
        
    ];
    }

    public function PaymentResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "response_code" => 200,
                "response_message" => 'success',
                "response_content" => 'Request received successfully',
                "response_timestamp" => '2020-07-19T16:39:49.685'
            ]
        ];
    }

    public function GenerateEnterpriseTokenRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            'x-client-id' => 'abcdefghijklmnop',
            'x-client-secret' => 'abcdefghijklmnop',
            'x-request-token' => 'abcdefghijklmnop',
            "payload" => [
                "sourceCode" => 'W3S',
                "affiliateCode" => 'EGH',
                "transactionDescription" => 'Test Data',
                "amount" => 50.0,
                "accountNo" => '1000002061405',
                "ccy" => 'GHS',
                "accountType" => 'A',
                "senderName" => 'AGENCY TEST',
                "senderMobileNo" => '',
                "senderId" => '',
                "beneficiaryName" => 'Agency Test',
                "beneficiaryMobileNo" => '1000002061405'
            ]
        ];
    }

    public function GenerateEnterpriseTokenResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "sourceCode" => 'W3S',
                "requestId" => '10001',
                "affiliateCode" => 'EGH',
                "responseCode" => '000',
                "responseMessage" => 'SUCCESS',
                "token" => '123456789012',
                "systemRefNo" => 'CATM601703786122',
                "expiryDate" => '2020-01-31'
            ]
        ];
    }

    public function AccountNameEnquiryRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            'x-client-id' => 'abcdefghijklmnop',
            'x-client-secret' => 'abcdefghijklmnop',
            'x-request-token' => 'abcdefghijklmnop',
            "payload" => [
                "affiliateCode" => 'ENG',
                "sourceCode" => 'PALMPAY',
                "accountNo" => '1441000302953'
            ]
        ];
    }

    public function AccountNameEnquiryResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "responseCode" => '000',
                "responseMessage" => 'SUCCESS',
                "accountName" => 'EBENEZER ASAMOAH-BEDIAKO',
                "accountNo" => '1441000302953',
                "affiliateCode" => 'EGH'
            ]
        ];
    }

    public function BalanceRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            'x-client-id' => 'abcdefghijklmnop',
            'x-client-secret' => 'abcdefghijklmnop',
            'x-request-token' => 'abcdefghijklmnop',
            "payload" => [
                "affiliateCode" => 'ENG',
                "sourceCode" => 'PALMPAY',
                "accountNo" => '1441000302953'
            ]
        ];
    }

    public function BalanceResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "accountStatus" => 'ACTIVE',
                "accountClass" => 'GHSAIN',
                "accountName" => 'EBENEZER ASAMOAH-BEDIAKO',
                "accountNo" => '1441000302953',
                "accountType" => 'S',
                "accrCr" => 0,
                "accrDr" => 0,
                "affiliateCode" => 'EGH',
                "availableBalance" => 304727.96,
                "blockedAmount" => 0,
                "branchCode" => 'H01',
                "currencyCode" => 'GHS',
                "currentBalance" => 304727.96,
                "openingBalance" => 304727.96,
                "customerId" => '410315313',
                "mtdToVCR" => 0,
                "mtdToVDR" => 0,
                "subLimit" => 0,
                "todLimit" => 0,
                "transactionFlag" => 'N',
                "udf1" => null,
                "udf2" => '1441000302953',
                "customerType" => 'I',
                "identityType" => 'NATIONAL_DRIVER_LIC',
                "identityValue" => 'ASAM090884GR01',
                "telephone" => '233244368890,233244368890',
                "phone" => null,
                "email" => 'eben.asamoah7@gmail.com',
                "country" => 'GH',
                "city" => 'ACCRA',
                "address" => 'P O BOX KB 253KORLE BU',
                "accountOfficer" => null,
                "alternateAccountNo" => '0013014424412801',
                "ccy" => 'GHS',
                "responseCode" => '000',
                "responseMessage" => 'SUCCESS'
            ]
        ];
    }

    public function TransferRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            'x-client-id' => 'abcdefghijklmnop',
            'x-client-secret' => 'abcdefghijklmnop',
            'x-request-token' => 'abcdefghijklmnop',

            "payload" => [
                "hostHeaderInfo" =>  [
                    "partnerId" => 'PALMPAY',
                    "countryCode" => 'NG',
                    "transferType" => '',
                    "requestId" => '33MG101746975',
                    "sourceIp" => '189.210.155.254'
                ],
                "transactionDetails" => [
                    "externalRefNo" => '627034220705508',
                    "paymentReferenceNo" => '627034220705508',
                    "amount" => 1,
                    "currency" => 'NGN',
                    "narration" => 'Wallet to Bank',
                    "transactionDate" => '2020-01-31',
                    "beneficiary" => [
                        "accountName" => 'MANTE OLABISI',
                        "bankCode" => '300591',
                        "accountNo" => '0244304915',
                        "accountType" => 'A'
                ]
                
            ]
            ],
        ];
        
    }

    public function TransferResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "externalRefNo" => '627034220705508',
                "paymentReferenceNo" => '627034220705508',
                "cbaReferenceNo" => 'ZEXA9900022818',
                "responseCode" => '000',
                "responseMessage" => 'SUCCESS'
            ]
        ];
    }

    public function TransactionStatusRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            'x-client-id' => 'abcdefghijklmnop',
            'x-client-secret' => 'abcdefghijklmnop',
            'x-request-token' => 'abcdefghijklmnop',

            "payload" => [
                "affiliateCode" => 'EGH',
                "sourceCode" => 'W3S',
                "accountNo" => '1441000302953',
                "branchCode" => 'H01'
            ],
        ];
        
    }

    public function TransactionStatusResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "responseCode" => '000',
                "responseMessage" => 'SUCCESS',
                "accountNo" => '1441000302953',
                "frozen" => 'N',
                "dormant" => 'N',
                "postAllowed" => 'Y',
                "postNoDebit" => 'N',
                "postNoCredit" => 'N'
            ]
        ];
    }

    public function AgentNameEnquiryRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            'x-client-id' => 'abcdefghijklmnop',
            'x-client-secret' => 'abcdefghijklmnop',
            'x-request-token' => 'abcdefghijklmnop',

            "payload" => [
                "hostHeaderInfo" => [
                    "partnerId" => '001',
                    "countryCode" => 'GHA',
                    "requestId" => '124545454'
                ],
                "accountNo" => '233264067798',
                "accountEntityCode" => '10133'
            ],
        ];
        
    }

    public function AgentNameEnquiryResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "hostHeaderInfo" => [
                    "partnerId" => 'APIGHA',
                    "requestId" => '33TF022217299',
                    "responseCode" => '000',
                    "responseMessage" => 'SUCCESS'
                ],
                "productLists" => [
                    [
                        "productCode" => 'CASHTOACCT',
                        "productDesc" => 'CASH TO ACCOUNT'
                    ],
                    [
                        "productCode" => 'CASHTOCASH',
                        "productDesc" => 'CASH TO CASH'
                    ]
                ],
                "affiliateList" => [
                    [
                        "affiliateCluster" => '1',
                        "affiliateDesc" => 'ECOBANK BENIN',
                        "affiliateId" => '961',
                        "countryCode" => 'BJ',
                        "currency" => 'XOF'
                    ],
                    [
                        "affiliateCluster" => '1',
                        "affiliateDesc" => 'ECOBANK BURKINA FASO',
                        "affiliateId" => '962',
                        "countryCode" => 'BF',
                        "currency" => 'XOF'
                    ],
                ]
            ]
        ];
    }

    public function InitiateReceiveCashRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            'x-client-id' => 'abcdefghijklmnop',
            'x-client-secret' => 'abcdefghijklmnop',
            'x-request-token' => 'abcdefghijklmnop',

            "payload" => [
                "hostHeaderInfo" => [
                    "partnerId" => 'APIGHA',
                    "countryCode" => '',
                    "requestId" => '33TF022217299',
                    "requestToken" => '0207d674c7a05b3a4f5a01743f8',
                    "sourceIp" => '189.210.155.254'
                ],
                "testAnswer" => 'TEST',
                "sendExternalRef" => 'REF73337373737',
                "referenceNumber" => 'RTC000067506394',
                "receiveType" => 'CASH',
                "receiveAccountNumber" => '0013014486638202',
                "agentCode" => 'LUMO',
                "mobilePhone" => '2349028292929',
                "firstName" => 'FOLASHADE',
                "lastName" => 'ADEBOWALE',
                "emailAddress" => 'afolashade@ecobank.com',
                "dob" => '23-Aug-1997',
                "nationality" => 'ENG',
                "country" => 'ENG',
                "contactAddress" => '17, Abiola Street, Osoba, Lagos',
                "gender" => 'F',
                "title" => 'MRS',
                "identificationType" => 'NATIONAL_ID_CARD',
                "identificationNumber" => 'NIM102',
                "issueDate" => '23-Aug-2018',
                "expireDate" => '23-Aug-2022'
            ],
        ];
        
    }

    public function InitiateReceiveCashResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "responseMessage" => 'SUCCESS'
            ]
        ];
    }

    public function completeReceiveRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            'x-client-id' => 'abcdefghijklmnop',
            'x-client-secret' => 'abcdefghijklmnop',
            'x-request-token' => 'abcdefghijklmnop',

            "payload" => [
                "hostHeaderInfo" => [
                    "partnerId" => 'APIGHA',
                    "countryCode" => '',
                    "requestId" => '33TF022217299',
                    "requestToken" => '0207d674c7a05b3a4f5a01743f8',
                    "sourceIp" => '189.210.155.254'
                ],
                "testAnswer" => 'TEST',
                "sendExternalRef" => 'REF73337373737',
                "referenceNumber" => 'RTC000067506394',
                "receiveType" => 'TOACCOUNT',
                "receiveAccountNumber" => '0013014486638202',
                "agentCode" => 'LUMO',
                "mobilePhone" => '2349028292929',
                "firstName" => 'FOLASHADE',
                "lastName" => 'ADEBOWALE',
                "emailAddress" => 'afolashade@ecobank.com',
                "dob" => '23-Aug-1997',
                "nationality" => 'ENG',
                "country" => 'ENG',
                "contactAddress" => '17, Abiola Street, Osoba, Lagos',
                "gender" => 'F',
                "title" => 'MRS',
                "identificationType" => 'NATIONAL_ID_CARD',
                "identificationNumber" => 'NIM102',
                "issueDate" => '23-Aug-2018',
                "expireDate" => '23-Aug-2022'
            ],
        ];
        
    }

    public function completeReceiveResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "responseMessage" => 'SUCCESS'
            ]
        ];
    }

    public function AgentTransactionStatusRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            'x-client-id' => 'abcdefghijklmnop',
            'x-client-secret' => 'abcdefghijklmnop',
            'x-request-token' => 'abcdefghijklmnop',

            "payload" => [
                "hostHeaderInfo" => [
                    "partnerId" => 'LUMO',
                    "countryCode" => 'NG',
                    "requestId" => '33TF022217299',
                    "requestToken" => '0207d674c7a05b3a4f5a01743f87f115ee30ea5e5aea22aa40b43aa001a6814a1c7357abeb7ba59a7c1033914c7cd680380f2a3436191d709f381af40db42cab'
                ],
                "tranRef" => 'RTC077263704073'  
            ],
        ];
        
    }

    public function AgentTransactionStatusResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "hostHeaderInfo" => [
                    "partnerId" => 'LUMO',
                    "requestId" => '33TF022217299',
                    "responseCode" => '000',
                    "responseMessage" => 'SUCCESS'
                ],
                "status" => [
                    "cbaReferenceNo" => 'RTC077263704073',
                    "charges" => 0,
                    "deliveryMethod" => 'ACCTOCASH',
                    "otherCharges" => 0,
                    "rate" => 65.13761,
                    "receiveAmount" => 364.77,
                    "receiveDate" => null,
                    "receiveRespCode" => null,
                    "receiveResponseMsg" => null,
                    "sendAmount" => 5.6,
                    "sendRespCode" => '000',
                    "sendRespMsg" => 'TRANSACTION WAS SUCCESSFUL',
                    "sendStatus" => null,
                    "totalAmount" => 5.6,
                    "tranRef" => 'RTC077263704073',
                    "transactionDate" => '2019-11-12 12:11:02.0',
                    "vatAmount" => 0
                ]
            ]
        ];
    }

    public function InternationalNameInquiryRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            'x-client-id' => 'abcdefghijklmnop',
            'x-client-secret' => 'abcdefghijklmnop',
            'x-request-token' => 'abcdefghijklmnop',
            "payload" => [
                "hostHeaderInfo" => [
                    "partnerId" => 'MOBILEAPP',
                    "requestId" => '33TF022217299',
                    "countryCode" => 'NG'
                ],
                "accountorMobileNo" => '2153000015',
                "accountorMobileType" => 'A',
                "accountEntityCode" => '050' 
            ],
        ];
        
    }

    public function InternationalNameInquiryResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "hostHeaderInfo" => [
                    "partnerId" => '001',
                    "requestId" => '124454545',
                    "responseCode" => '000',
                    "responseMessage" => 'SUCCESS'
                ],
                "name" => 'KOSSIVI SELOM AFELI',
                "ccy" => 'GHS',
                "status" => 'A',
                "nameInquiryRef" => 'REF2045'
            ]
        ];
    }

    public function PostTransferRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            'x-client-id' => 'abcdefghijklmnop',
            'x-client-secret' => 'abcdefghijklmnop',
            'x-request-token' => 'abcdefghijklmnop',
            "payload" => [
                "hostHeaderInfo" => [
                    "partnerId" => 'MOBILEAPP',
                    "countryCode" => 'NG',
                    "requestId" => '33TF022247303'
                ],
                "transactionDetails" => [
                    "tranRef" => 'ECO1234567890115',
                    "sendAmount" => 1,
                    "sendCurrency" => 'USD',
                    "sendCountry" => 'US',
                    "exchangeRate" => 5.15,
                    "receiveAmount" => 5.15,
                    "destinationCurrency" => 'GHS',
                    "destinationCountry" => 'GH',
                    "deliveryMethod" => 'CASH',
                    "tranSecret" => '0',
                    "secretAnswer" => 'OK',
                    "tranReason" => 'Personal Allowance',
                    "tranNarration" => 'Professional travel',
                    "sender" => [
                        "firstName" => 'MANTE',
                        "lastName" => 'ALBERT',
                        "idNumber" => 'WEWR323132DSA',
                        "idType" => 'PASSPORT',
                        "idIssueDate" => '',
                        "idExpiryDate" => '',
                        "nationality" => '',
                        "phoneNumber" => '233277430232',
                        "email" => 'amante@ecobank.com',
                        "address" => '',
                        "countryOfResidence" => 'GH',
                        "accountNumber" => '70405836225'
                    ],
                    "beneficiary" => [
                        "firstName" => 'MANTE',
                        "lastName" => 'ALBERT',
                        "beneficiaryName" => 'MANTE ALBERT',
                        "idNumber" => 'WEWR323132DSA',
                        "idType" => 'PASSPORT',
                        "idIssueDate" => '',
                        "idExpiryDate" => '',
                        "nationality" => '',
                        "phoneNumber" => '233277430232',
                        "email" => 'amante@ecobank.com',
                        "address" => '',
                        "countryOfResidence" => 'GH',
                        "bankCode" => '13',
                        "accountType" => 'X',
                        "accountNumber" => '233243973293'
                    ]
                ]
            ],
        ];
        
    }

    public function PostTransferResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "hostHeaderInfo" => [
                    "partnerId" => 'MOBILEAPP',
                    "requestId" => '33MG101746976',
                    "responseCode" => '000',
                    "responseMessage" => 'SUCCESS'
                ],
                "externalRefNo" => 'ECO1234567890116',
                "CBAReferenceNo" => 'H01MCLG9937748272'
            ]
        ];
    }

    public function fetchRateFeesRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            'x-client-id' => 'abcdefghijklmnop',
            'x-client-secret' => 'abcdefghijklmnop',
            'x-request-token' => 'abcdefghijklmnop',
            "payload" => [
                "hostHeaderInfo" => [
                    "partnerId" => 'MOBILEAPP',
                    "countryCode" => 'NG',
                    "requestId" => '33TF022217299'
                ],
                "rateandfees" => [
                    "amount" => 500,
                    "amountType" => 'SENDAMT',
                    "sendCountry" => 'US',
                    "sendCcy" => 'USD',
                    "receiveCountry" => 'GH',
                    "receiveCcy" => 'GHS',
                    "deliveryMethod" => '',
                    "tranType" => ''
                ]
            ],
        ];
        
    }

    public function fetchRateFeesResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "hostHeaderInfo" => [
                    "partnerId" => 'MOBILEAPP',
                    "requestId" => '33TF022217299',
                    "responseCode" => '000',
                    "responseMessage" => 'Success'
                ],
                "rateandfees" => [
                    "sendCountry" => 'USA',
                    "sendBankCode" => 'EIN',
                    "destinationCountry" => 'EGH',
                    "destinationBankCode" => 'EGH',
                    "sendAmount" => '500',
                    "receiveAmount" => '162500.00',
                    "totalCharge" => '0.0',
                    "exchRate" => '325.0000',
                    "amountType" => 'SENDAMT',
                    "deliveryTimeInHour" => '1.0',
                    "chargePayer" => 'SENDERPAY',
                    "transferCurrency" => 'USD'
                ]
            ]
        ];
    }

    public function FetchInstitutionsListRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            'x-client-id' => 'abcdefghijklmnop',
            'x-client-secret' => 'abcdefghijklmnop',
            'x-request-token' => 'abcdefghijklmnop',
            "payload" => [
                "hostHeaderInfo" => [
                    "partnerId" => 'MOBILEAPP',
                    "requestId" => '33TF022217299',
                    "countryCode" => 'GH'
                ],
                "destinationCountry" => 'BJ'
            ],
        ];
        
    }

    public function FetchInstitutionsListResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "hostHeaderInfo" => [
                    "partnerId" => 'MOBILEAPP',
                    "requestId" => '33TF022217299',
                    "responseCode" => '000',
                    "responseMessage" => 'Success'
                ],
                "institutionLists" => [
                    [
                        "countryCode" => 'EBJ',
                        "institutionId" => 'AFICBJBJXXX',
                        "institutionName" => 'Baic',
                        "institutionType" => 'BANK'
                    ]
                ]
            ]
        ];
    }

    public function InternationalTransactionStatusRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            'x-client-id' => 'abcdefghijklmnop',
            'x-client-secret' => 'abcdefghijklmnop',
            'x-request-token' => 'abcdefghijklmnop',
            "payload" => [
                "hostHeaderInfo" => [
                    "partnerId" => 'MOBILEAPP',
                    "countryCode" => 'NG',
                    "requestId" => '33TF022217299'
                ],
                "sendAccountNo" => '2741120095',
                "externalRefNo" => '33TF705525047'
            ],
        ];
        
    }

    public function InternationalTransactionStatusResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "hostHeaderInfo" => [
                    "partnerId" => 'MOBILEAPP',
                    "requestId" => '33TF022217299',
                    "requestToken" => '0207d674c7a05b3a4f5a01743f87f115ee30ea5e5aea22aa40b43aa001a6814a1c7357abeb7ba59a7c1033914c7cd6803 80f2a3436191d709f381af40db42cab',
                    "responseCode" => '000',
                    "responseMessage" => 'SUCCESS'
                ],
                "tranRef" => 'RT0821595662',
                "txnStatusCode" => '000',
                "txnStatusMessage" => 'SUCCESS',
                "cbaReferenceNo" => '90761079',
                "transactionDate" => '2019-07-11 15:11:32.0'
            ]
        ];
    }

    public function FetchRateRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            'x-client-id' => 'abcdefghijklmnop',
            'x-client-secret' => 'abcdefghijklmnop',
            'x-request-token' => 'abcdefghijklmnop',
            "payload" => [
                "hostHeaderInfo" => [
                    "partnerId" => 'LXCHANGE',
                    "countryCode" => 'GH',
                    "requestId" => '33TF022217299'
                ],
                "rate" => [
                    "amount" => 500,
                    "amountType" => 'SENDAMT',
                    "sendCountry" => 'US',
                    "sendCcy" => 'USD',
                    "receiveCountry" => 'GH',
                    "receiveCcy" => 'GHS',
                    "deliveryMethod" => '',
                    "tranType" => ''
                ]
            ],
        ];
        
    }

    public function FetchRateResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "hostHeaderInfo" => [
                    "partnerId" => 'LXCHANGE',
                    "requestId" => '33TF022217299',
                    "responseCode" => '000',
                    "responseMessage" => 'SUCCESS'
                ],
                "rate" => [
                    "sendCountry" => 'US',
                    "sendCcy" => 'USD',
                    "receiveCountry" => 'GH',
                    "receiveCcy" => 'GHS',
                    "exchangeRate" => '5.36'
                ]
            ]
        ];
    }

    public function InitiateAgentReceiveRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            'x-client-id' => 'abcdefghijklmnop',
            'x-client-secret' => 'abcdefghijklmnop',
            'x-request-token' => 'abcdefghijklmnop',
            "payload" => [
                "agentCode" => 'AGENTVINOD',
                "testAnswer" => 'TEST',
                "sendExternalRef" => '73337373737',
                "referenceNumber" => 'RTC000067506394',
                "clientID" => 'BRN',
                "moduleValue" => '4df9bf9be716bccf6b61d64851311dbe501c30ad81daa4e05353ed6ad4df93e7fb15cf3ea9d96cbf22c50662c537d9fab7b4d43c393f16664ea308c5071a66d7'
            ],
        ];
        
    }

    public function InitiateAgentReceiveResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "agentCode" => 'AGENTVINOD',
                "purposeOfTransfer" => '',
                "purposeOfTransfer2" => '',
                "testQuestionOthers" => '',
                "receiverPhonePrefix" => '',
                "clientID" => 'BRN',
                "receiverPhoneNumber" => '994384448',
                "receiveEmailAddress" => 'atsdtftf@yahoo.com',
                "receiveIdType" => 'INTERNATIONAL PASSPORT',
                "receiveIdNumber" => '373733773201004272',
                "receiveLastName" => 'AYJIBADE',
                "receiveFirstName" => 'AYODEJI',
                "holdFundReference" => '',
                "clientName" => '',
                "sendCustomer" => '',
                "sourceaccountBrnCode" => '',
                "receiveStatus" => '',
                "destaccountBrnCode" => '',
                "queryPurpose" => '',
                "sourceAffiliateCode" => '',
                "destAffiliateCode" => '',
                "amounType" => '',
                "sourceAmount" => '',
                "responseCode" => '000',
                "responseMsg" => 'SUCCESS',
            ]
        ];
    }

    public function CompleteRapidReceiveRequest()
    {
        return [
            "sandbox_key" => "abcdefghijklmnop",
            'x-client-id' => 'abcdefghijklmnop',
            'x-client-secret' => 'abcdefghijklmnop',
            'x-request-token' => 'abcdefghijklmnop',
            "payload" => [
                "sendExternalRef" => '454744747474',
                "testAnswer" => '*******',
                "referenceNumber" => 'RT47441238383',
                "clientID" => 'ART',
                "moduleValue" => '4df9bf9be716bccf6b61d64851311dbe501c30ad81daa4e05353ed6ad4df93e7fb15cf3ea9d96cbf22c50662c537d9fab7b4d43c393f16664ea308c5071a66d7'
            ],
        ];
        
    }

    public function CompleteRapidReceiveResponse()
    {
        return [
            "message" => "OK",
            "data" =>
            [
                "clientID" => 'ART',
                "moduleValue" => '181730524fad70960570d915a7d7eaa3ea3897bf9a77357c29d90596eaab260e81d865da954f1d25652e594eed4dffcbe97d05aaeaba708dd627982759d17ee3',
                "destAffiliate" => 'EGH',
                "sourceAffiliate" => 'ENG',
                "sendAmount" => '5',
                "receiveAmount" => '.07',
                "totalAmount" => '5.24',
                "vatAmount" => '0',
                "charges" => '.12',
                "otherCharges" => '.12',
                "purposeOfTransfer" => 'BUSINESS',
                "purposeOfTransfer2" => '',
                "receiverPhoneNumber" => '08034930062',
                "receiveEmailAddress" => 'Aydeggy@yahoo.com',
                "receiveIdType" => 'Int PassPort',
                "receiveIdNumber" => '2333333',
                "receiveLastName" => 'Ajibade ',
                "receiveFirstName" => 'Ayodeji',
                "narration" => 'for goods i buy now',
                "transactionChannel" => 'ART',
                "product" => 'ACCTOACC',
                "Rate" => '0.002908',
                "destCrncy" => 'GHS',
                "sourceCrncy" => 'NGN',
                "responseCode" => '000',
                "responseMsg" => 'SUCCESS'
            ]
        ];
    }
}