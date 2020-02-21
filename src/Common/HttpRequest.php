<?php

namespace InnovationSandbox\Common;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use InnovationSandbox\NIBSS\Common\Hash;
use InnovationSandbox\Common\Utils\ErrorHandler;

class HttpRequest {
private $client, $baseURL;

public function __construct(Client $client=null){
    $this->client = $client ? $client : new Client();
    $this->hash = new Hash();
}


public function request($credentials){
    try{
        $this->baseURL = ($credentials['host'] ? 
        $credentials['host'] : 'https://sandboxapi.fsi.ng');

        return $this->client->request(
            $credentials['method'], 
            $this->baseURL.$credentials['path'], 
            $credentials['requestData']);

    } catch(RequestException $error){
        return ErrorHandler::apiError($error);
    } catch(\Exception $error){
        return ErrorHandler::moduleError($error);
    } 
}

}