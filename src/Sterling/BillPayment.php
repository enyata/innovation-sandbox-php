<?php

namespace InnovationSandbox\Sterling;

use GuzzleHttp\Client;
use InnovationSandbox\Sterling\Common\ModuleRequest;

class BillPayment
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function BillPaymentAdvice($data)
    {
        try {
            $data['path'] = '/sterling/billpaymentapi/api/Spay/BillPaymtAdviceRequestISW';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function BillersPaymentItems($data)
    {
        try {
            $data['path'] = '/sterling/billpaymentapi/api/Spay/GetBillerPmtItemsRequest';
            $params = isset($data['params']) ? $data['params'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', '', $params, $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function BillersISW($data)
    {
        try {
            $data['path'] = '/sterling/billpaymentapi/api/Spay/GetBillersISWRequest';
            $params = isset($data['params']) ? $data['params'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', '', $params, $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
