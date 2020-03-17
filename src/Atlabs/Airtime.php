<?php
namespace InnovationSandbox\Atlabs;

use GuzzleHttp\Client;
use InnovationSandbox\Atlabs\Common\ModuleRequest;

class Airtime {
    private $httpRequest, $client;

    public function __construct(Client $client=null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function SendAirtime($host = '', $key='', $payload='') {
        try{
            $data = [
                "path" => '/atlabs/airtime/send',
                "host" => $host,
                "method" => 'POST',
                "sandbox_key" => $key,
                "payload" => $payload
            ];

            return $this->httpRequest->trigger($data);
        } catch(\Exception $error) {
            return $error->getMessage();
        }
    }
}
