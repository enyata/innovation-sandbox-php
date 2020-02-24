<?php
require_once './vendor/autoload.php';

class Sterling {
    private $faker;
    
    public function __construct(){
        $this->faker = Faker\Factory::create();
    }

    public function nameEnquiryRequest() {
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

    public function nameEnquiryReponse() {
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

    public function interbankRequest() {
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

    public function interbankResponse() {
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

}
