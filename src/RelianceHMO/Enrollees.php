<?php

namespace InnovationSandbox\RelianceHMO;

use GuzzleHttp\Client;
use InnovationSandbox\RelianceHMO\Common\ModuleRequest;

class Enrollees
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function Register($data)
    {
        try {
            $data['path'] = '/relianceHMO/enrollees';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function GetEnrollees($data)
    {
        try {
            $data['path'] = '/relianceHMO/enrollees';
            $params = isset($data['params']) ? $data['params'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', '', $params, $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function GetEnrollee($data)
    {
        try {
            $id = isset($data['id']) ? $data['id'] : '';
            $data['path'] = '/relianceHMO/enrollees/' . $id;
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', '', '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function Profile($data)
    {
        try {
            $data['path'] = '/relianceHMO/enrollees/profile';
            $params = isset($data['params']) ? $data['params'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'PUT', '', $params, $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function Validate($data)
    {
        try {
            $data['path'] = '/relianceHMO/enrollees/validate';
            $params = isset($data['params']) ? $data['params'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', '', $params, $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function Card($data)
    {
        try {
            $data['path'] = '/relianceHMO/enrollees/id-card';
            $params = isset($data['params']) ? $data['params'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', '', $params, $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
