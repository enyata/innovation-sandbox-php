<?php

namespace InnovationSandbox\Union;

use GuzzleHttp\Client;
use InnovationSandbox\Union\Common\ModuleRequest;

class Token
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function GenerateToken($host = '', $key = '', $payload = [])
    {
        try {
            $data = [
                'path' => '/union/oauth/token',
                'method' => 'POST',
                'host' => $host,
                'payload' => $payload,
                'sandbox_key' => $key,
            ];

            return $this->httpRequest->trigger($data, '', 'application/x-www-form-urlencoded');
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
