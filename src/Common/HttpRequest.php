<?php

namespace InnovationSandbox\Common;

// require_once __DIR__ . '/../../vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use InnovationSandbox\NIBSS\Common\Hash;
use InnovationSandbox\Common\Utils\ErrorHandler;

class HttpRequest {
private $client, 
        $baseURL, 
        $response,
        $aes_key,
        $ivkey;

public function __construct(){
    $this->client = new Client();
    $this->hash = new Hash();
}


public function trigger($credentials){
    try{
        $this->baseURL = ($credentials["host"] ? $credentials["host"] : 'https://innovation-sandbox-backend.herokuapp.com');
        $organisation_code = base64_encode($credentials["organisation_code"]);
        $data; $encrypetedBVN;
        $headers = [
            "OrganisationCode" => $organisation_code,
            "Sandbox-Key" => $credentials["sandbox_key"]
        ];

        if($credentials["aes_key"] && $credentials["ivkey"]){
            $this->aes_key = $credentials["aes_key"];
            $this->ivkey = $credentials["ivkey"];
            $bvnData = $this->hash->BVNData($credentials["organisation_code"], $credentials["password"]);
            $encrypetedBVN = $this->hash->encrypt(json_encode($credentials["payload"]), $this->aes_key, $this->ivkey); 
            $headers = array_merge($headers, $bvnData);
            $headers["Accept"] = "application/json";
            $headers["Content-Type"] = "application/json";
        }

        $this->response = $this->client->request('POST', $this->baseURL.$credentials["path"], [
            "headers" => $headers, 
            "body" => $encrypetedBVN
        ]);
            
        $body = $this->response->getBody()->getContents();

        if(strlen($body > 0)){
            $data = $this->hash->decrypt($body, $credentials["aes_key"], $credentials["ivkey"]);
            return $data;
        }

        $data = [
            'password' =>$this->response->getHeader('password')[0],
            'ivkey' => $this->response->getHeader('ivkey')[0],
            'aes_key' => $this->response->getHeader('aes_key')[0]
        ];

        return $data;
    } catch(RequestException $error){
        return $error;
        return ErrorHandler::apiError($error);
    } catch(\Exception $error){
        return $error;
        return ErrorHandler::moduleError($error);
    } 
}

}