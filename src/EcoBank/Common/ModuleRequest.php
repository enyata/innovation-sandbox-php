<?php

namespace InnovationSandbox\EcoBank\Common;

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


    public function trigger($host = '', $method = 'POST', $payload = '', $params = '', $credentials, $user_headers = [])
    {
        try {
            $authorization = '';
            $this->host = isset($credentials['host']) ? $credentials['host'] : '';

            if(isset($credentials['access_token'])){
                $authorization = "Bearer ".$credentials['access_token'];
            }

            $headers = [
                'Sandbox-Key' => $credentials['sandbox_key'],
                'Authorization' => $authorization,
                'Content-Type' => 'application/json'
            ];

            $headers = array_merge($headers, $user_headers);

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
        }
        catch (\Exception $error) {
            return ErrorHandler::moduleError($error);
        }
    }
}