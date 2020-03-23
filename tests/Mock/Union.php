<?php
require_once './vendor/autoload.php';

class Union
{
    private $faker, $sandbox_key;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
        $this->sandbox_key = 'abcdefghijklmnop';
    }

    public function KeyErrorResponse()
    {
        return [
            'error' => [],
            'statusCode' => 401
        ];
    }

    public function InvalidKeyErrorResponse()
    {
        return [
            'error' => [],
            'statusCode' => 403
        ];
    }

    public function WrongPayloadErrorResponse()
    {
        return [
            'error' => [],
            'statusCode' => 400
        ];
    }

    public function TokenRequest()
    {
        return [
            'host' => 'hbvhjbh',
            'sandbox_key' => $this->sandbox_key,
            'payload' => [
                'client_secret' => 'secret',
                'client_id ' => 'web01',
                'grant_type' => 'password',
                'username' => 'ubnclient01',
                'password' => 'w$777'
            ]
        ];
    }

    public function TokenResponse()
    {
        return [
            'message' => 'OK',
            'data' => [
                'access_token' => $this->faker->uuid(),
                'token_type' => 'bearer',
                'refresh_token' => $this->faker->uuid(),
                'expires_in' => 899,
                'scope'    => 'read'
            ]
        ];
    }
    public function AccountEnquiryRequest()
    {
        return [
            'host' => 'hbvhjbh',
            'sandbox_key' => $this->sandbox_key,
            'payload' => [
                'accountNumber' => '0000791200',
                'accountType' => 'CASA'
            ],
            'token' => $this->faker->uuid()
        ];
    }

    public function AccountEnquiryResponse()
    {
        return [
            'message' => 'OK',
            'data' => [
                'code' => '00',
                'message' => 'Account Enquiry Successful',
                'accountNumber' => '0000791200',
                'accountName' => 'AWE ODUNAYO',
                'accountBranchCode' => '682',
                'customerNumber' =>    '004607380',
                'accountClass' => 'CA_044',
                'accountCurrency' => 'NGN',
                'accountType' => 'Current',
                'availableBalance' => '5861',
                'customerAddress' => '29 ALIU STREET OFF IJOKA ROAD AKURE LAGOS',
                'customerEmail' => 'myawesoft@yahoo.com',
                'customerPhoneNumber' => '08032227456'
            ]
        ];
    }

    public function CustomerEnquiryRequest()
    {
        return [
            'host' => 'hbvhjbh',
            'sandbox_key' => $this->sandbox_key,
            'payload' => [
                'accountNumber' => '0000791200',
                'accountType' => 'CASA'
            ],
            'token' => $this->faker->uuid()
        ];
    }

    public function CustomerEnquiryResponse()
    {
        return [
            'message' => 'OK',
            'data' => [
                'code' => '00',
                'message' => 'Customer Enquiry Successful',
                'country' => 'NG',
                'countryOfBirth' =>    null,
                'dob' => '1981-12-21',
                'nationality' => 'NG',
                'lastName' => 'AWE',
                'firstName' => 'ODUNAYO',
                'otherNames' => null,
                'customerType' => 'I',
                'emai' => 'myawesoft@yahoo.com',
                'phoneNumber' => '08032227456',
                'idType' => 'OTHERS',
                'idNumber' => '4626183',
                'countryOfIssue' =>    null,
                'effectiveDate' => '2009-06-11',
                'expiryDate' => '2032-06-10',
                'addressLine1' => '29 ALIU STREET',
                'addressLine2' => 'OFF IJOKA ROAD',
                'city' => 'AKURE',
                'state' => 'LAGOS',
                'postalCode' => null,
                'bvn' => '12345678',
            ]
        ];
    }

    public function CustomerAndAccountEnquiryRequest()
    {
        return [
            'host' => 'hbvhjbh',
            'sandbox_key' => $this->sandbox_key,
            'payload' => [
                'accountNumber' => '0000791200',
                'accountType' => 'CASA'
            ],
            'token' => $this->faker->uuid()
        ];
    }

    public function CustomerAndAccountEnquiryResponse()
    {
        return [
            'message' => 'OK',
            'data' => [
                'code' => '00',
                'message' => 'Enquiry Successful',
                'account' => [
                    'code' => '00',
                    'message' => 'Account Enquiry Successful',
                    'reference' => null,
                    'accountNumber' => '0000791200',
                    'accountName' => 'AWE ODUNAYO',
                    'accountBranchCode' => '682',
                    'customerNumber' => '004607380',
                    'accountClass' => 'CA_044',
                    'accountCurrency' => 'NGN',
                    'accountType' => 'current',
                    'availableBalance' => '5861',
                    'customerAddress' => '29 ALIU STREET OFF IJOKA ROAD AKURE LAGOS',
                    'customerEmail' => 'myawesoft@yahoo.com',
                    'customerPhoneNumber' => '08032227456',
                ],
                'customer' => [
                    'code' => '00',
                    'message' => 'Customer Enquiry Successful',
                    'country' => 'NG',
                    'countryOfBirth' => null,
                    'dob' => '1981-12-21',
                    'nationality' => 'NG',
                    'lastName' => 'AWE',
                    'firstName' => 'ODUNAYO',
                    'otherNames' => null,
                    'customerTyoe' => 'I',
                    'email' =>  'myawesoft@yahoo.com',
                    'phoneNumer' => '29 ALIU STREET OFF IJOKA ROAD AKURE LAGOS',
                    'customerEmail' => '08032227456',
                    'idType' => 'OTHERS',
                    'idNumber' => '4626183',
                    'countryOfIssue' => null,
                    'effectiveDate' => '2009-06-11',
                    'expiryDate' => '2032-06-10',
                    'addressLine1' => '29 ALIU STREET',
                    'addressLine2' => 'OFF IJOKA ROAD',
                    'city' => 'AKURE',
                    'state' => 'LAGOS',
                    'postalCode' => null,
                ]
            ]
        ];
    }

    public function UpdateCredentialsRequest()
    {
        return [
            'host' => 'hbvhjbh',
            'sandbox_key' => $this->sandbox_key,
            'payload' => [
                'username' => 'user1',
                'oldPassword' => 'password2',
                'password' => 'password',
                'moduleId' => 'UNION_ONE',
                'clientSecret' => 'ABC',
            ],
            'token' => $this->faker->uuid()
        ];
    }

    public function UpdateCredentialsResponse()
    {
        return [
            'message' => 'OK',
            'data' => [
                'code' => '00',
                'message' => 'Password Changes successfully',
                'reference' => null
            ]
        ];
    }
}
