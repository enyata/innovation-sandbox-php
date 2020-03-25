<?php

namespace InnovationSandbox\Union;

use GuzzleHttp\Client;
use InnovationSandbox\Union\Common\ModuleRequest;

class User
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function UpdateCredentials($host = '', $key = '', $payload = [], $token = '')
    {
        try {
            $data = [
                "path" => '/union//secured/changeusercredentials',
                'method' => 'POST',
                'host' => $host,
                'payload' => $payload,
                'sandbox_key' => $key,
            ];

            return $this->httpRequest->trigger($data, ['access_token' => $token]);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
