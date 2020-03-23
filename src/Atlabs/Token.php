<?php

namespace InnovationSandbox\Atlabs;

use GuzzleHttp\Client;
use InnovationSandbox\Atlabs\Common\ModuleRequest;

class Token
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function CheckoutToken($host = '', $key = '', $payload = '')
    {
        try {
            $data = [
                'path' => '/atlabs/token/checkout',
                'method' => 'POST',
                'host' => $host,
                'payload' => $payload,
                'sandbox_key' => $key
            ];

            return $this->httpRequest->trigger($data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
