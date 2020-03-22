<?php

namespace InnovationSandbox\NIBSS\Common;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use InnovationSandbox\NIBSS\Common\Hash;
use InnovationSandbox\Common\Utils\ErrorHandler;
use InnovationSandbox\Common\HttpRequest;

class ModuleRequest
{
    private $client,
        $response,
        $aes_key,
        $ivkey,
        $http,
        $host,
        $encrypetedBVN;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->hash = new Hash();
        $this->http = new HttpRequest($this->client);
    }


    public function trigger($credentials)
    {
        try {
            $this->host = isset($credentials['host']) ? $credentials['host'] : '';
            $organisation_code = base64_encode($credentials['organisation_code']);

            $headers = [
                'OrganisationCode' => $organisation_code,
                'Sandbox-Key' => $credentials['sandbox_key']
            ];

            if (isset($credentials['aes_key']) && isset($credentials['ivkey'])) {
                $this->aes_key = $credentials['aes_key'];
                $this->ivkey = $credentials['ivkey'];
                $bvnData = $this->hash->BVNData(
                    $credentials['organisation_code'],
                    $credentials['password']
                );

                $this->encrypetedBVN = $this->hash->encrypt(
                    json_encode($credentials['payload']),
                    $this->aes_key,
                    $this->ivkey
                );

                $headers = array_merge($headers, $bvnData);
                $headers['Accept'] = 'application/json';
                $headers['Content-Type'] = 'application/json';
            }

            $requestData = [
                'headers' => $headers,
                'body' => $this->encrypetedBVN
            ];

            $this->response = $this->http->request([
                'host' => $this->host,
                'path' => $credentials['path'],
                'method' => $credentials['method'],
                'requestData' => $requestData
            ]);


            $body = $this->response->getBody()->getContents();

            if (strlen($body > 0)) {
                return $this->hash->decrypt(
                    $body,
                    $credentials['aes_key'],
                    $credentials['ivkey']
                );
            }


            return [
                'password' => $this->response->getHeader('password')[0],
                'ivkey' => $this->response->getHeader('ivkey')[0],
                'aes_key' => $this->response->getHeader('aes_key')[0]
            ];
        } catch (RequestException $error) {
            return ErrorHandler::apiError($error);
        } catch (\Exception $error) {
            return ErrorHandler::moduleError($error);
        }
    }
}
