<?php

namespace InnovationSandbox\Common;

// require_once __DIR__ . '/../../vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use InnovationSandbox\NIBSS\Common\Hash;
use InnovationSandbox\NIBSS\Bvnr;
use InnovationSandbox\Common\Utils\ErrorHandler;

class HttpRequest {
private $client, 
        $baseURL, 
        $response,
        $aes_key,
        $ivkey;

public function __construct(Client $client=null){
    $this->client = $client ? $client : new Client();
    $this->hash = new Hash();
}


public function request($credentials){
    try{
        $this->baseURL = ($credentials["host"] ? $credentials["host"] : 'https://sandboxapi.fsi.ng');

        return $this->client->request('POST', $this->baseURL.$credentials["path"], [
            "headers" => $credentials['headers'], 
            "body" => $credentials['body']
        ]);

    } catch(RequestException $error){
        return ErrorHandler::apiError($error);
    } catch(\Exception $error){
        return ErrorHandler::moduleError($error);
    } 
}

}