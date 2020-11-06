<?php

namespace InnovationSandbox\FCMB\Wallet;

use GuzzleHttp\Client;
use InnovationSandbox\FCMB\Common\ModuleRequest;

class Transaction
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function getTransactionHistory($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/Transaction/AccountNumber';
            $params = isset($data['params']) ? $data['params'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', '', $params, $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function retrieveWalletTransactionDetails($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/Transaction/Category/Id';
            $params = isset($data['params']) ? $data['params'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', '',  $params, $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function wallet2AccountTransfer($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/Transfer/W2Account';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function balanceEnquiry($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/balanceEnqiry';
            $params = isset($data['params']) ? $data['params'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', '', $params, $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
    
    public function createBankLink($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/BankLink';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function getDataPlan($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/Transfer/Dataplan';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function airtimeTopUp($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/Transfer/Airtime';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function transferData($data)
    {
        try {
            $data['path'] = '/fcmb/wallet/Transfer/Data';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }   
      
}
