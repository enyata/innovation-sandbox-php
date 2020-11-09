<?php

namespace InnovationSandbox\EcoBank;

use GuzzleHttp\Client;
use InnovationSandbox\EcoBank\Common\ModuleRequest;

class CorporateAPI
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function GenerateToken($data)
    {
        try {
            $data['path'] = '/ecobank/corporateapi/user/token';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function CardPayment($data)
    {
        try {
            $consumerLabKey = isset($data['payload']['consumer_lab_key']) ? $data['consumer_lab_key'] : '';
            $data['payload']['secureHash'] = hash('sha512', $consumerLabKey);
            $data['path'] = '/ecobank/corporateapi/merchant/card';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'access_token' => isset($data['access_token']) ? $data['access_token'] : ''
            ];
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function MomoPayment($data)
    {
        try {
            $consumerLabKey = isset($data['payload']['consumer_lab_key']) ? $data['consumer_lab_key'] : '';
            $data['payload']['secureHash'] = hash('sha512', $consumerLabKey);
            $data['path'] = '/ecobank/corporateapi/merchant/momo';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'access_token' => isset($data['access_token']) ? $data['access_token'] : ''
            ];

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function MCC($data)
    {
        try {
            $consumerLabKey = isset($data['payload']['consumer_lab_key']) ? $data['consumer_lab_key'] : '';
            $data['payload']['secureHash'] = hash('sha512', $consumerLabKey);
            $data['path'] = '/ecobank/corporateapi/merchant/getmcc';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'access_token' => isset($data['access_token']) ? $data['access_token'] : ''
            ];

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function CreateQR($data)
    {
        try {
            $consumerLabKey = isset($data['payload']['consumer_lab_key']) ? $data['consumer_lab_key'] : '';
            $data['payload']['secureHash'] = hash('sha512', $consumerLabKey);
            $data['path'] = '/ecobank/corporateapi/merchant/createqr';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'access_token' => isset($data['access_token']) ? $data['access_token'] : ''
            ];

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function QR($data)
    {
        try {
            $consumerLabKey = isset($data['payload']['consumer_lab_key']) ? $data['consumer_lab_key'] : '';
            $data['payload']['secureHash'] = hash('sha512', $consumerLabKey);
            $data['path'] = '/ecobank/corporateapi/merchant/qr';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'access_token' => isset($data['access_token']) ? $data['access_token'] : ''
            ];

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function Statement($data)
    {
        try {
            $consumerLabKey = isset($data['payload']['consumer_lab_key']) ? $data['consumer_lab_key'] : '';
            $data['payload']['secureHash'] = hash('sha512', $consumerLabKey);
            $data['path'] = '/ecobank/corporateapi/merchant/statement';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'access_token' => isset($data['access_token']) ? $data['access_token'] : ''
            ];

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function Payment($data)
    {
        try {
            $consumerLabKey = isset($data['payload']['consumer_lab_key']) ? $data['consumer_lab_key'] : '';
            $data['payload']['secureHash'] = hash('sha512', $consumerLabKey);
            $data['path'] = '/ecobank/corporateapi/payment/payment';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'access_token' => isset($data['access_token']) ? $data['access_token'] : ''
            ];

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
