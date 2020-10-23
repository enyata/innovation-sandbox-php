<?php

namespace InnovationSandbox\SWIFT;

use GuzzleHttp\Client;
use InnovationSandbox\SWIFT\Common\ModuleRequest;

class SwiftPrevalPilot
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function Verification($data)
    {
        try {
            $data['path'] = '/swift/swift-preval-pilot/v1/accounts/verification';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'LAUApplicationID' => isset($data['LAUApplicationID']) ? $data['LAUApplicationID'] : '',
                'LAUCallTime' => isset($data['LAUCallTime']) ? $data['LAUCallTime'] : '',
                'LAURequestNonce' => isset($data['LAURequestNonce']) ? $data['LAURequestNonce'] : '',
                'LAUVersion' => isset($data['LAUVersion']) ? $data['LAUVersion'] : '',
                'x-api-key' => isset($data['x-api-key']) ? $data['x-api-key'] : '',
                'LAUSignature' => isset($data['LAUSignature']) ? $data['LAUSignature'] : '',
                'LAUSigned' => isset($data['LAUSigned']) ? $data['LAUSigned'] : ''
            ];

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data, $headers);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
