<?php

namespace InnovationSandbox\RelianceHMO;

use GuzzleHttp\Client;
use InnovationSandbox\RelianceHMO\Common\ModuleRequest;

class Clients
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function Signup($data)
    {
        try {
            $data['path'] = '/relianceHMO/clients/signup';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';


            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function Renew($data)
    {
        try {
            
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $data['path'] = '/relianceHMO/clients/' . $data['id'] . '/renew';
            
            return $this->httpRequest->trigger($host, 'PUT', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
