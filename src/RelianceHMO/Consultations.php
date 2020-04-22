<?php

namespace InnovationSandbox\RelianceHMO;

use GuzzleHttp\Client;
use InnovationSandbox\RelianceHMO\Common\ModuleRequest;

class Consultations
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function Request($data)
    {
        try {
            $data['path'] = '/relianceHMO/consultations';
            $params = isset($data['params']) ? $data['params'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', '', $params, $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
