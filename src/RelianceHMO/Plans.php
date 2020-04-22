<?php

namespace InnovationSandbox\RelianceHMO;

use GuzzleHttp\Client;
use InnovationSandbox\RelianceHMO\Common\ModuleRequest;

class Plans
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function AvailablePlans($data)
    {
        try {
            $data['path'] = '/relianceHMO/plans';
            $params = isset($data['params']) ? $data['params'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', '', $params, $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
