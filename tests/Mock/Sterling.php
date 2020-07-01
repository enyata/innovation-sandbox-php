<?php
require_once './vendor/autoload.php';

class Sterling
{
    private $faker;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
    }

    public function InvalidKeyRequest()
    {
        return [
            'sandbox_key' => 'some_key',
            'subscription_key' => 't'
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
            'sandbox_key' => '',
            'subscription_key' => 't'
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

    public function nameEnquiryRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'subscription_key' => 't',
            'Appid' => $this->faker->regexify('[0-9]{10}'),
            'ipval' => 0,
            'params'  => [
                'Referenceid' => $this->faker->regexify('[0-9]{10}'),
                'RequestType' => $this->faker->regexify('[0-9]{10}'),
                'Translocation' => $this->faker->regexify('[0-9]{10}'),
                'ToAccount' => $this->faker->regexify('[0-9]{10}'),
                'destinationbankcode' => $this->faker->regexify('[0-9]{10}')
            ]
        ];
    }

    public function nameEnquiryReponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'message' => 'success',
                'response' => 'success',
                'data' =>
                [
                    'AccountName' => $this->faker->regexify('[0-9]{10}'),
                    'sessionID' => $this->faker->regexify('[0-9]{10}'),
                    'AccountNumber' => $this->faker->regexify('[0-9]{10}'),
                    'status' => '97',
                    'BVN' => $this->faker->regexify('[0-9]{10}'),
                    'ResponseText' => null
                ]
            ]
        ];
    }

    public function interbankRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'subscription_key' => 't',
            'Appid' => $this->faker->regexify('[0-9]{10}'),
            'ipval' => 0,
            'payload'  => [
                'Referenceid' => $this->faker->regexify('[0-9]{10}'),
                'RequestType' => $this->faker->regexify('[0-9]{10}'),
                'Translocation' => $this->faker->regexify('[0-9]{10}'),
                'SessionID' => $this->faker->regexify('[0-9]{10}'),
                'FromAccount' => $this->faker->regexify('[0-9]{10}'),
                'ToAccount' => $this->faker->regexify('[0-9]{10}'),
                'Amount' => $this->faker->regexify('[0-9]{10}'),
                'DestinationBankCode' => $this->faker->regexify('[0-9]{10}'),
                'NEResponse' => $this->faker->regexify('[0-9]{10}'),
                'BenefiName' => $this->faker->regexify('[0-9]{10}'),
                'PaymentReference' => $this->faker->regexify('[0-9]{10}'),
                'OriginatorAccountName' => $this->faker->regexify('[0-9]{10}'),
                'translocation' => $this->faker->regexify('[0-9]{10}'),
            ]
        ];
    }

    public function interbankResponse()
    {
        return [
            'message' => 'OK',
            'data' =>
            [
                'message' => 'success',
                'response' => 'success',
                'responsedata' => null,
                'data' =>
                [
                    'ResponseText' => 'Your transaction has been submitted for processing.',
                    'status' => '00'
                ]
            ]
        ];
    }


    public function mobileWalletRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'subscription_key' => 't',
            'payload'  => [
                'Referenceid' => $this->faker->regexify('[0-9]{10}'),
                'RequestType' => $this->faker->regexify('[0-9]{10}'),
                'Translocation' => $this->faker->regexify('[0-9]{10}'),
                'amt' => $this->faker->regexify('[A-Za-z0-9]{7}'),
                'tellerid' => $this->faker->regexify('[A-Za-z0-9]{7}'),
                'frmacct' => $this->faker->regexify('[A-Za-z0-9]{7}'),
                'toacct' => $this->faker->regexify('[A-Za-z0-9]{7}'),
                'exp_code' => $this->faker->regexify('[A-Za-z0-9]{7}'),
                'paymentRef' => $this->faker->regexify('[A-Za-z0-9]{7}'),
                'remarks' => $this->faker->regexify('[A-Za-z0-9]{7}')
            ]
        ];
    }

    public function mobileWalletResponse()
    {
        return [
            'message' => 'OK',
            'data' => [
                'Status' => '200 OK',
                'Response' => '00',
                'Data' => 'Sent'
            ]
        ];
    }

    public function GetBillerPmtItemsResponse()
    {
        return [
            'message' => 'OK',
            'data' => [
                'Status' => '200 OK',
                'Response' => '00',
                'Message' => 'Message sent was successful'
            ]
        ];
    }

    public function GetBillerPmtItemsRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'subscription_key' => 't',
            'params'  => [
                'Referenceid' => '01',
                'RequestType' => '01',
                'Translocation' => '01',
                'Bvn' => $this->faker->regexify('[A-Za-z0-9]{7}'),
                'billerid' => $this->faker->regexify('[A-Za-z0-9]{7}')
            ]
        ];
    }

    public function GetBillersISWResponse()
    {
        return [
            'message' => 'OK',
            'data' => [
                'Status' => '200 OK',
                'Response' => '00',
                'Message' => 'Message sent was successful'
            ]
        ];
    }

    public function GetBillersISWRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'subscription_key' => 't',
            'params'  => [
                'Referenceid' => '01',
                'RequestType' => '01',
                'Translocation' => '01',
                'Bvn' => $this->faker->regexify('[A-Za-z0-9]{7}')
            ]
        ];
    }

    public function BillPaymtAdviceResponse()
    {
        return [
            'message' => 'OK',
            'data' => [
                'Status' => '200 OK',
                'Response' => '00',
                'Message' => 'Message sent was successful'
            ]
        ];
    }

    public function BillPaymtAdviceRequest()
    {
        return [
            'sandbox_key' => 'abcdefghijklmnop',
            'subscription_key' => 't',
            'payload'  => [
                "Referenceid" =>  '01',
                "RequestType" =>  '0',
                "Translocation" =>  '01',
                "amt" =>  $this->faker->regexify('[A-Za-z0-9]{7}'),
                "paymentcode" =>  $this->faker->regexify('[A-Za-z0-9]{7}'),
                "mobile" =>  $this->faker->regexify('[A-Za-z0-9]{7}'),
                "SubscriberInfo1" =>  $this->faker->regexify('[A-Za-z0-9]{7}'),
                "ActionType" =>  $this->faker->regexify('[A-Za-z0-9]{7}'),
                "nuban" =>  $this->faker->regexify('[A-Za-z0-9]{7}'),
                "email" =>  $this->faker->regexify('[A-Za-z0-9]{7}')
            ]
        ];
    }
}
