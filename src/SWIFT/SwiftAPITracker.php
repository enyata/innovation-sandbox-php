<?php

namespace InnovationSandbox\SWIFT;

use GuzzleHttp\Client;
use InnovationSandbox\SWIFT\Common\ModuleRequest;

class SwiftAPITracker
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function Status($data)
    {
        try {
            $data['path'] = isset($data['payment_id']) ? '/swift/swift-api-tracker/v4/payments/'. $data['payment_id'].'/status' : 
                '/swift/swift-api-tracker/v4/payments/1/status';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'access_token' => isset($data['access_token']) ? $data['access_token'] : ''
            ];

            return $this->httpRequest->trigger($host, 'PUT', '', '', $data, $headers);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function Transactions($data)
    {
        try {
            $data['path'] = isset($data['payment_id']) ? '/swift/swift-api-tracker/v4/payments/'. $data['payment_id'].'/transactions' : 
                '/swift/swift-api-tracker/v4/payments/1/transactions';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'access_token' => isset($data['access_token']) ? $data['access_token'] : ''
            ];

            return $this->httpRequest->trigger($host, 'GET', '', '', $data, $headers);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function Cancellation($data)
    {
        try {
            $data['path'] = isset($data['payment_id']) ? '/swift/swift-api-tracker/v4/payments/'. $data['payment_id'].'/cancellation' : 
                '/swift/swift-api-tracker/v4/payments/1/cancellation';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'access_token' => isset($data['access_token']) ? $data['access_token'] : ''
            ];

            return $this->httpRequest->trigger($host, 'GET', $payload, '', $data, $headers);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
