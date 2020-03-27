<?php

namespace InnovationSandbox\Union;

use GuzzleHttp\Client;
use InnovationSandbox\Union\Common\ModuleRequest;

class Enquiry
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function Account($host = '', $key = '', $payload = [], $token = '')
    {
        try {
            $data = [
                'path' => '/union/secured/cbaaccountenquiry',
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

    public function Customer($host = '', $key = '', $payload = '', $token = '')
    {
        try {
            $data = [
                'path' => '/union/secured/cbacustomerenquiry',
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

    public function CustomerAccount($host = '', $key = '', $payload = [], $token = '')
    {
        try {
            $data = [
                'path' => '/union/secured/cbacustomeraccountenquiry',
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
