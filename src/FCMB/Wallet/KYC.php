<?php

namespace InnovationSandbox\FCMB\Wallet;

use GuzzleHttp\Client;
use InnovationSandbox\FCMB\Common\ModuleRequest;

class KYC
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function getCustomerKYC($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/KYC';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function createCustomerKYC($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/KYC';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function updateCustomerKYC($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/KYC';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'PUT', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function updateKYCStatus($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/KYC/Status';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'PUT', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
