<?php

namespace InnovationSandbox\SWIFT;

use GuzzleHttp\Client;
use InnovationSandbox\SWIFT\Common\ModuleRequest;

class Authorization
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function oauth2($data)
    {
        try {
            $data['path'] = '/swift/oauth2/v1/token';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'consumer_key' => isset($data['consumer_key']) ? $data['consumer_key'] : '',
                'consumer_secret' => isset($data['consumer_secret']) ? $data['consumer_secret'] : ''
            ];

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data, $headers);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
