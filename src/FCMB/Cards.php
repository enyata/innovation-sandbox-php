<?php

namespace InnovationSandbox\FCMB;

use GuzzleHttp\Client;
use InnovationSandbox\FCMB\Common\ModuleRequest;

class Cards
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function retrieveCardType($data)
    {
        try {
            $data['path'] = '/fcmb/cards/cardType';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', '', '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
    public function insertCardType($data)
    {
        try {
            $data['path'] = '/fcmb/cards/cardType';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function updateCardType($data)
    {
        try {
            $data['path'] = '/fcmb/cards/cardType';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'PUT', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
    public function retrieveCardRequest($data)
    {
        try {
            $data['path'] = '/fcmb/cards/cardRequest';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
    public function createCardRequest($data)
    {
        try {
            $data['path'] = '/fcmb/cards/cardRequest';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
