<?php

namespace InnovationSandbox\Sterling;

use GuzzleHttp\Client;
use InnovationSandbox\Sterling\Common\ModuleRequest;

class Wallet
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function Mobile($data)
    {
        try {
            $data['path'] = '/sterling/accountapi/api/Spay/SBPMWalletRequest';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
