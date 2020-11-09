<?php

namespace InnovationSandbox\EcoBank;

use GuzzleHttp\Client;
use InnovationSandbox\EcoBank\Common\ModuleRequest;

class EnterpriseIntegration
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function GenerateToken($data)
    {
        try {
            $data['path'] = '/ecobank/enterpriseIntegration/e-eco-api/xpress/token';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'x-client-id' => isset($data['x-client-id']) ? $data['x-client-id'] : '',
                'x-client-secret' => isset($data['x-client-secret']) ? $data['x-client-secret'] : '',
                'x-request-token' => isset($data['x-request-token']) ? $data['x-request-token'] : ''
            ];
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function AccountNameEnquiry($data)
    {
        try {
            $data['path'] = '/ecobank/enterpriseIntegration/e-eco-api/accout/nameInquiry';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'x-client-id' => isset($data['x-client-id']) ? $data['x-client-id'] : '',
                'x-client-secret' => isset($data['x-client-secret']) ? $data['x-client-secret'] : '',
                'x-request-token' => isset($data['x-request-token']) ? $data['x-request-token'] : ''
            ];
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function Balance($data)
    {
        try {
            $data['path'] = '/ecobank/enterpriseIntegration/e-eco-api/account/balance';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'x-client-id' => isset($data['x-client-id']) ? $data['x-client-id'] : '',
                'x-client-secret' => isset($data['x-client-secret']) ? $data['x-client-secret'] : '',
                'x-request-token' => isset($data['x-request-token']) ? $data['x-request-token'] : ''
            ];
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function Transfer($data)
    {
        try {
            $data['path'] = '/ecobank/enterpriseIntegration/e-eco-api/transfer';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'x-client-id' => isset($data['x-client-id']) ? $data['x-client-id'] : '',
                'x-client-secret' => isset($data['x-client-secret']) ? $data['x-client-secret'] : '',
                'x-request-token' => isset($data['x-request-token']) ? $data['x-request-token'] : ''
            ];
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function TransactionStatus($data)
    {
        try {
            $data['path'] = '/ecobank/enterpriseIntegration/e-eco-api/transaction/status';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'x-client-id' => isset($data['x-client-id']) ? $data['x-client-id'] : '',
                'x-client-secret' => isset($data['x-client-secret']) ? $data['x-client-secret'] : '',
                'x-request-token' => isset($data['x-request-token']) ? $data['x-request-token'] : ''
            ];
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function AgentNameEnquiry($data)
    {
        try {
            $data['path'] = '/ecobank/enterpriseIntegration/e-unified-api/mock/rt/agent/nameInquiry';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'x-client-id' => isset($data['x-client-id']) ? $data['x-client-id'] : '',
                'x-client-secret' => isset($data['x-client-secret']) ? $data['x-client-secret'] : '',
                'x-request-token' => isset($data['x-request-token']) ? $data['x-request-token'] : ''
            ];
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function InitiateReceiveCash($data)
    {
        try {
            $data['path'] = '/ecobank/enterpriseIntegration/e-unified-api/mock/rt/agent/initiateReceiveCash';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'x-client-id' => isset($data['x-client-id']) ? $data['x-client-id'] : '',
                'x-client-secret' => isset($data['x-client-secret']) ? $data['x-client-secret'] : '',
                'x-request-token' => isset($data['x-request-token']) ? $data['x-request-token'] : ''
            ];
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function CompleteReceive($data)
    {
        try {
            $data['path'] = '/ecobank/enterpriseIntegration/e-unified-api/mock/rt/agent/completeReceive';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'x-client-id' => isset($data['x-client-id']) ? $data['x-client-id'] : '',
                'x-client-secret' => isset($data['x-client-secret']) ? $data['x-client-secret'] : '',
                'x-request-token' => isset($data['x-request-token']) ? $data['x-request-token'] : ''
            ];
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function AgentTransactionStatus($data)
    {
        try {
            $data['path'] = '/ecobank/enterpriseIntegration/e-unified-api/mock/rt/agent/transactionStatus';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'x-client-id' => isset($data['x-client-id']) ? $data['x-client-id'] : '',
                'x-client-secret' => isset($data['x-client-secret']) ? $data['x-client-secret'] : '',
                'x-request-token' => isset($data['x-request-token']) ? $data['x-request-token'] : ''
            ];
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function InternationalNameInquiry($data)
    {
        try {
            $data['path'] = '/ecobank/enterpriseIntegration/e-international-remittance/international/nameInquiry';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'x-client-id' => isset($data['x-client-id']) ? $data['x-client-id'] : '',
                'x-client-secret' => isset($data['x-client-secret']) ? $data['x-client-secret'] : '',
                'x-request-token' => isset($data['x-request-token']) ? $data['x-request-token'] : ''
            ];
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

        public function PostTransfer($data)
    {
        try {
            $data['path'] = '/ecobank/enterpriseIntegration/e-international-remittance/international/postTransfer';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'x-client-id' => isset($data['x-client-id']) ? $data['x-client-id'] : '',
                'x-client-secret' => isset($data['x-client-secret']) ? $data['x-client-secret'] : '',
                'x-request-token' => isset($data['x-request-token']) ? $data['x-request-token'] : ''
            ];
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function FetchRateFees($data)
    {
        try {
            $data['path'] = '/ecobank/enterpriseIntegration/e-international-remittance/international/fetchRateFees';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'x-client-id' => isset($data['x-client-id']) ? $data['x-client-id'] : '',
                'x-client-secret' => isset($data['x-client-secret']) ? $data['x-client-secret'] : '',
                'x-request-token' => isset($data['x-request-token']) ? $data['x-request-token'] : ''
            ];
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function FetchInstitutionsList($data)
    {
        try {
            $data['path'] = '/ecobank/enterpriseIntegration/e-international-remittance/international/fetchInstitutionsList';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'x-client-id' => isset($data['x-client-id']) ? $data['x-client-id'] : '',
                'x-client-secret' => isset($data['x-client-secret']) ? $data['x-client-secret'] : '',
                'x-request-token' => isset($data['x-request-token']) ? $data['x-request-token'] : ''
            ];
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function InternationalTransactionStatus($data)
    {
        try {
            $data['path'] = '/ecobank/enterpriseIntegration/e-international-remittance/international/transactionStatus';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'x-client-id' => isset($data['x-client-id']) ? $data['x-client-id'] : '',
                'x-client-secret' => isset($data['x-client-secret']) ? $data['x-client-secret'] : '',
                'x-request-token' => isset($data['x-request-token']) ? $data['x-request-token'] : ''
            ];
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function FetchRate($data)
    {
        try {
            $data['path'] = '/ecobank/enterpriseIntegration/-international-remittance/international/fetchRate';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            $host = isset($data['host']) ? $data['host'] : '';
            $headers = [
                'x-client-id' => isset($data['x-client-id']) ? $data['x-client-id'] : '',
                'x-client-secret' => isset($data['x-client-secret']) ? $data['x-client-secret'] : '',
                'x-request-token' => isset($data['x-request-token']) ? $data['x-request-token'] : ''
            ];
            return $this->httpRequest->trigger($host, 'POST', $payload, '', $data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
