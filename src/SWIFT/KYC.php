<?php

namespace InnovationSandbox\SWIFT;

use GuzzleHttp\Client;
use InnovationSandbox\SWIFT\Common\ModuleRequest;

class KYC
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function EntityList($data)
    {
        try {
            $data['path'] = '/swift/kyc/v1/entities/my';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'access_token' => isset($data['access_token']) ? $data['access_token'] : ''
            ];

            return $this->httpRequest->trigger($host, 'GET', '', '', $data, $headers);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function CounterParty($data)
    {
        try {
            $data['path'] = '/swift/kyc/v1/entities/counterparty';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'access_token' => isset($data['access_token']) ? $data['access_token'] : ''
            ];

            return $this->httpRequest->trigger($host, 'GET', '', '', $data, $headers);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
