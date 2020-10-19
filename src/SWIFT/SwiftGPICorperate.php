<?php

namespace InnovationSandbox\SWIFT;

use GuzzleHttp\Client;
use InnovationSandbox\SWIFT\Common\ModuleRequest;

class SwiftGPIForCorporates
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function Transactions($data)
    {
        try {
            $data['path'] = '/swift/swift-gpi-for-corporates/v4/customers/payments/transactions';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'x-bic' => isset($data['x-bic']) ? $data['x-bic'] : '',
                'client' => isset($data['client']) ? $data['client'] : ''
            ];

            return $this->httpRequest->trigger($host, 'GET', $payload, '', $data, $headers);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function Inbound($data)
    {
        try {
            $data['path'] = '/swift/swift-gpi-for-corporates/v4/customers/payments/inbound';
            $params = isset($data['params']) ? $data['params'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'x-bic' => isset($data['x-bic']) ? $data['x-bic'] : '',
                'client' => isset($data['client']) ? $data['client'] : ''
            ];

            return $this->httpRequest->trigger($host, 'GET', '', $params, $data, $headers);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
