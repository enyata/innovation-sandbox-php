<?php

namespace InnovationSandbox\FCMB;

use GuzzleHttp\Client;
use InnovationSandbox\FCMB\Common\ModuleRequest;

class Authentication
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function validateByCustomerId($data)
    {
        try {
            $data['path'] = '/fcmb/authentication/validateByCustomerId';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
