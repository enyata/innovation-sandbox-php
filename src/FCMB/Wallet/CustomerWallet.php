<?php

namespace InnovationSandbox\FCMB\Wallet;

use GuzzleHttp\Client;
use InnovationSandbox\FCMB\Common\ModuleRequest;

class CustomerWallet
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function retrieveWalletBallance($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/Customerwallet/Balance';
            $params = isset($data['params']) ? $data['params'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', '', $params, $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function updateWalletBallance($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/Customerwallet/Balance';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'PUT', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function createWallet($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/Customerwallet/new';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
    public function updateWalletStatus($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/Customerwallet/Status';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'PUT', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
    public function validateWalletCode($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/validateCode';
            $params = isset($data['params']) ? $data['params'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', '',  $params, $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
