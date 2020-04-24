<?php

namespace InnovationSandbox\RelianceHMO;

use GuzzleHttp\Client;
use InnovationSandbox\RelianceHMO\Common\ModuleRequest;

class Wallet
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function Fund($data)
    {
        try {
            $data['path'] = '/relianceHMO/wallet/fund';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function Transactions($data)
    {
        try {
            $data['path'] = '/relianceHMO/wallet/transactions';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function Balance($data)
    {
        try {
            $data['path'] = '/relianceHMO/wallet';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
