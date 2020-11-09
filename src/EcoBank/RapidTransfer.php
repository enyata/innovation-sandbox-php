<?php

namespace InnovationSandbox\EcoBank;

use GuzzleHttp\Client;
use InnovationSandbox\EcoBank\Common\ModuleRequest;

class RapidTransfer
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function InitiateAgentReceive($data)
    {
        try {
            $data['path'] = '/ecobank/RapidTransfer/channelServices/initiateReceiveForAgent';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'x-client-id' => isset($data['x-client-id']) ? $data['x-client-id'] : '',
                'x-client-secret' => isset($data['x-client-secret']) ? $data['x-client-secret'] : '',
                'x-request-token' => isset($data['x-request-token']) ? $data['x-request-token'] : '',
                'x-request-source-code' => isset($data['x-request-source-code']) ? $data['x-request-source-code'] : ''
            ];
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function CompleteReceive($data)
    {
        try {
            $data['path'] = '/ecobank/RapidTransfer/channelServices/completeReceive';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'x-client-id' => isset($data['x-client-id']) ? $data['x-client-id'] : '',
                'x-client-secret' => isset($data['x-client-secret']) ? $data['x-client-secret'] : '',
                'x-request-token' => isset($data['x-request-token']) ? $data['x-request-token'] : '',
                'x-request-source-code' => isset($data['x-request-source-code']) ? $data['x-request-source-code'] : ''
            ];
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
