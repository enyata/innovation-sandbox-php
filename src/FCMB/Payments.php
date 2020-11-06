<?php

namespace InnovationSandbox\FCMB;

use GuzzleHttp\Client;
use InnovationSandbox\FCMB\Common\ModuleRequest;

class Payments
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function b2bSingleTransfer($data)
    {
        try {
            $data['path'] = '/fcmb/payments/b2b/transfers';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
    public function internalB2BSingleTransfer($data)
    {
        try {
            $data['path'] = '/fcmb/payments/b2b/internal/transfers';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function createInternalTransfer($data)
    {
        try {
            $data['path'] = '/fcmb/payments/internal/transfers';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
    public function getInternalTransfer($data)
    {
        try {
            $data['path'] = '/fcmb/payments/internal/transfers';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function internalTransferDateRange($data)
    {
        try {
            $data['path'] = '/fcmb/payments/internal/transfers/DateRange';
            $params = isset($data['params']) ? $data['params'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', '', $params, $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function internalTransferStatus($data)
    {
        try {
            $data['path'] = '/fcmb/payments/internal/transfers/Status';
            $params = isset($data['params']) ? $data['params'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', '', $params, $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function nipSingleFundsTransfer($data)
    {
        try {
            $data['path'] = '/fcmb/payments/nip/transfers';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
    public function nipTransferDateRange($data)
    {
        try {
            $data['path'] = '/fcmb/payments/nip/transfers/DateRange';
            $params = isset($data['params']) ? $data['params'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', '', $params, $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
    public function insertNIPCharge($data)
    {
        try {
            $data['path'] = '/fcmb/payments/nip/charge';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
    public function getNIPBanks($data)
    {
        try {
            $data['path'] = '/fcmb/payments/nip/banks';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', '', '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
    public function nipNameEnquiry($data)
    {
        try {
            $data['path'] = '/fcmb/payments/nip/name';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
    public function nipTransferStatus($data)
    {
        try {
            $data['path'] = '/fcmb/payments/nip/Status';
            $params = isset($data['params']) ? $data['params'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'GET', '',  $params, $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
    public function nibssTransferStatus($data)
    {
        try {
            $data['path'] = '/fcmb/payments/nibss/status';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';

            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
