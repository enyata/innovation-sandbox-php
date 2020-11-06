<?php

namespace InnovationSandbox\FCMB\Wallet;

use GuzzleHttp\Client;
use InnovationSandbox\FCMB\Common\ModuleRequest;

class Customer
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function createCustomer($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/Customer';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function updateCustomer($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/Customer';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'PUT', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function getCustomerByMobileNo($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/Customer/MobileNo';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function updateCustomerMobileNo($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/Customer/MobileNo';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'PUT', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function nameEnquiry($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/Customer/name';
            $params = isset($data['params']) ? $data['params'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', '',  $params, $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function setPin($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/Customer/Pin';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function setTransactionPassword($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/Customer/Password';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
