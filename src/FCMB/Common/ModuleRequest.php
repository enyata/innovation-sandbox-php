<?php

namespace InnovationSandbox\FCMB\Common;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use InnovationSandbox\Common\Utils\ErrorHandler;
use InnovationSandbox\Common\HttpRequest;

class ModuleRequest
{
    private $client,
        $response,
        $http;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->http = new HttpRequest($this->client);
    }


    public function trigger($host = '', $method = 'POST', $payload = '', $params = '', $credentials)
    {
        try {
            $clientID = isset($credentials['client-id']) ? $credentials['client-id'] : 'f';

            $headers = [
                'Sandbox-Key' => $credentials['sandbox_key'],
                'content-type' => 'application/json',
                'accept' => 'application/json',
                'x-ibm-client-id' => $clientID
            ];

            $requestData = [
                'headers' => $headers,
                'body' => json_encode($payload),
                'query' => $params
            ];
            $this->response = $this->http->request([
                'host' => $host,
                'path' => $credentials['path'],
                'method' => $method,
                'requestData' => $requestData
            ]);

            if (gettype($this->response) === 'array') {
                return $this->response;
            }

            return $this->response->getBody()->getContents();
        } catch (RequestException $error) {
            return ErrorHandler::apiError($error);
        } catch (\Exception $error) {
            return ErrorHandler::moduleError($error);
        }
    }
}
