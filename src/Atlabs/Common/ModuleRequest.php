<?php
namespace InnovationSandbox\Atlabs\Common;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use InnovationSandbox\Common\Utils\ErrorHandler;
use InnovationSandbox\Common\HttpRequest;

class ModuleRequest {
    private $client, $response, $http;
    
    public function __construct(Client $client=null) {
        $this->client = $client ? $client : new Client();
        $this->http = new HttpRequest($this->client);

    }

    public function trigger($data) {
        try{
            $headers = [
                "Sandbox-Key" => $data["sandbox_key"],
                'Content-Type' => 'application/json',
            ];
            
            $requestData = [
                "headers" => $headers,
                "body" => json_encode($data['payload']),
            ];
            
            $this->response = $this->http->request([
                'host' => $data['host'],
                'path' => $data["path"],
                'method' => $data['method'],
                'requestData' => $requestData
                ]);

                if(gettype($this->response) === 'array'){
                    return $this->response;
                }
                
                return $this->response->getBody()->getContents();
        } catch(RequestException $error) {
            return ErrorHandler::apiError($error);
        } catch(\Exception $error) {
            return ErrorHandler::moduleError($error);
        } 
    }   
}
