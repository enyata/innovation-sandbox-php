<?php

namespace InnovationSandbox\EcoBank;

use GuzzleHttp\Client;
use InnovationSandbox\EcoBank\Common\ModuleRequest;

class AgencyBanking
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function AirtimeBillers($data)
    {
        try {
            $data['path'] = '/ecobank/agencybanking/services/thirdpartyagencybanking/getairtimebillers';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function BuyAirtime($data)
    {
        try {
            $data['path'] = '/ecobank/agencybanking/services/thirdpartyagencybanking/buyairtime';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function Balance($data)
    {
        try {
            $data['path'] = '/ecobank/agencybanking/services/thirdpartyagencybanking/getbalance';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function CustomerDetails($data)
    {
        try {
            $data['path'] = '/ecobank/agencybanking/services/thirdpartyagencybanking/getcustomerdetails';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
