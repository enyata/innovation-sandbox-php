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
                'client_secret' => $this->faker->regexify('[A-Za-z0-9]{5}'),
                'client_id ' => $this->faker->regexify('[A-Za-z0-9]{5}'),
                'grant_type' => $this->faker->regexify('[A-Za-z0-9]{10}'),
                'username' => $this->faker->regexify('[A-Za-z0-9]{10}'),
                'password' => $this->faker->regexify('[A-Za-z0-9]{10}')
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
                'accountNumber' => $this->faker->regexify('[0-9]{10}'),
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
                'accountNumber' => $this->faker->regexify('[0-9]{10}'),
                'accountName' => $this->faker->firstName(),
                'accountBranchCode' => $this->faker->regexify('[0-9]{3}'),
                'customerNumber' =>    $this->faker->regexify('[0-9]{10}'),
                'accountClass' => $this->faker->regexify('[A-Za-z0-9]{5}'),
                'accountCurrency' => 'NGN',
                'accountType' => 'Current',
                'availableBalance' => $this->faker->regexify('[0-9]{10}'),
                'customerAddress' => $this->faker->address(),
                'customerEmail' => $this->faker->email(),
                'customerPhoneNumber' => $this->faker->regexify('[0-9]{10}')
            ]
        ];
    }

    public function CustomerEnquiryRequest()
    {
        return [
            'host' => 'hbvhjbh',
            'sandbox_key' => $this->sandbox_key,
            'payload' => [
                'accountNumber' => $this->faker->regexify('[0-9]{10}'),
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
                'dob' => $this->faker->regexify('[0-9]{10}'),
                'nationality' => 'NG',
                'lastName' => $this->faker->lastName(),
                'firstName' => $this->faker->firstName(),
                'otherNames' => null,
                'customerType' => 'I',
                'emai' => $this->faker->email(),
                'phoneNumber' => $this->faker->phoneNumber(),
                'idType' => 'OTHERS',
                'idNumber' => $this->faker->regexify('[A-Za-z0-9]{10}'),
                'countryOfIssue' =>    null,
                'effectiveDate' => $this->faker->date(),
                'expiryDate' => $this->faker->date(),
                'addressLine1' => $this->faker->address(),
                'addressLine2' => $this->faker->address(),
                'city' => $this->faker->city(),
                'state' => $this->faker->state(),
                'postalCode' => null,
                'bvn' => $this->faker->regexify('[0-9]{10}'),
            ]
        ];
    }

    public function CustomerAndAccountEnquiryRequest()
    {
        return [
            'host' => 'hbvhjbh',
            'sandbox_key' => $this->sandbox_key,
            'payload' => [
                'accountNumber' => $this->faker->regexify('[0-9]{10}'),
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
                    'accountNumber' => $this->faker->regexify('[0-9]{10}'),
                    'accountName' => $this->faker->name(),
                    'accountBranchCode' => $this->faker->regexify('[A-Za-z0-9]{10}'),
                    'customerNumber' => $this->faker->regexify('[0-9]{10}'),
                    'accountClass' => $this->faker->regexify('[A-Za-z0-9]{7}'),
                    'accountCurrency' => 'NGN',
                    'accountType' => 'current',
                    'availableBalance' => $this->faker->regexify('[0-9]{10}'),
                    'customerAddress' => $this->faker->address(),
                    'customerEmail' => $this->faker->email(),
                    'customerPhoneNumber' => $this->faker->regexify('[0-9]{10}'),
                ],
                'customer' => [
                    'code' => '00',
                'message' => 'Customer Enquiry Successful',
                'country' => 'NG',
                'countryOfBirth' =>    null,
                'dob' => $this->faker->regexify('[0-9]{10}'),
                'nationality' => 'NG',
                'lastName' => $this->faker->lastName(),
                'firstName' => $this->faker->firstName(),
                'otherNames' => null,
                'customerType' => 'I',
                'emai' => $this->faker->email(),
                'phoneNumber' => $this->faker->phoneNumber(),
                'idType' => 'OTHERS',
                'idNumber' => $this->faker->regexify('[A-Za-z0-9]{10}'),
                'countryOfIssue' =>    null,
                'effectiveDate' => $this->faker->date(),
                'expiryDate' => $this->faker->date(),
                'addressLine1' => $this->faker->address(),
                'addressLine2' => $this->faker->address(),
                'city' => $this->faker->city(),
                'state' => $this->faker->state(),
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
                'username' => $this->faker->regexify('[A-Za-z0-9]{10}'),
                'oldPassword' => $this->faker->regexify('[A-Za-z0-9]{10}'),
                'password' => $this->faker->regexify('[A-Za-z0-9]{10}'),
                'moduleId' => 'UNION_ONE',
                'clientSecret' => $this->faker->regexify('[A-Za-z0-9]{10}'),
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
