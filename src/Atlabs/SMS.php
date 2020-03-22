<?php

namespace InnovationSandbox\Atlabs;

use GuzzleHttp\Client;
use InnovationSandbox\Atlabs\Common\ModuleRequest;

class SMS
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function SMSService($host = '', $key = '', $payload = '')
    {
        try {
            $data = [
                "path" => '/atlabs/messaging',
                "method" => 'POST',
                "host" => $host,
                "payload" => $payload,
                "sandbox_key" => $key
            ];

            return $this->httpRequest->trigger($data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function Premium($host = '', $key = '', $payload = '')
    {
        try {
            $data = [
                "path" => '/atlabs/messaging/premium',
                "method" => 'POST',
                "host" => $host,
                "payload" => $payload,
                "sandbox_key" => $key
            ];

            return $this->httpRequest->trigger($data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function CreatePremium($host = '', $key = '', $payload = '')
    {
        try {
            $data = [
                "path" => '/atlabs/messaging/subscription',
                "method" => 'POST',
                "host" => $host,
                "payload" => $payload,
                "sandbox_key" => $key
            ];

            return $this->httpRequest->trigger($data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function DeletePremium($host = '', $key = '', $payload = '')
    {
        try {
            $data = [
                "path" => '/atlabs/messaging/subscription/delete',
                "method" => 'POST',
                "host" => $host,
                "payload" => $payload,
                "sandbox_key" => $key
            ];

            return $this->httpRequest->trigger($data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function FetchPremium($host = '', $key = '', $payload = '')
    {
        try {
            $data = [
                "path" => '/atlabs/messaging/subscription/fetch',
                "method" => 'POST',
                "host" => $host,
                "payload" => $payload,
                "sandbox_key" => $key
            ];

            return $this->httpRequest->trigger($data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function FetchMessages($host = '', $key = '', $payload = '')
    {
        try {
            $data = [
                "path" => '/atlabs/messaging/fetch',
                "method" => 'POST',
                "host" => $host,
                "payload" => $payload,
                "sandbox_key" => $key
            ];

            return $this->httpRequest->trigger($data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
