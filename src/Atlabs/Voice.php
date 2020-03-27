<?php

namespace InnovationSandbox\Atlabs;

use GuzzleHttp\Client;
use InnovationSandbox\Atlabs\Common\ModuleRequest;

class Voice
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function Call($host = '', $key = '', $payload = '')
    {
        try {
            $data = [
                'path' => '/atlabs/voice/call',
                'method' => 'POST',
                'host' => $host,
                'payload' => $payload,
                'sandbox_key' => $key
            ];

            return $this->httpRequest->trigger($data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function QueueStatus($host = '', $key = '', $payload = '')
    {
        try {
            $data = [
                'path' => '/atlabs/voice/queueStatus',
                'method' => 'POST',
                'host' => $host,
                'payload' => $payload,
                'sandbox_key' => $key
            ];

            return $this->httpRequest->trigger($data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function MediaUpload($host = '', $key = '', $payload = '')
    {
        try {
            $data = [
                'path' => '/atlabs/voice/mediaUpload',
                'method' => 'POST',
                'host' => $host,
                'payload' => $payload,
                'sandbox_key' => $key
            ];

            return $this->httpRequest->trigger($data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
