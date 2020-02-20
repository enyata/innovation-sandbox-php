<?php

namespace InnovationSandbox\NIBSS;

use InnovationSandbox\NIBSS\Common\ModuleRequest;
use GuzzleHttp\Client;

class PlaceHolder {
private $httpRequest;

    public function __construct(Client $client = null){
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function ValidateRecord($data){
        try{
            $data["path"] = '/nibss/BVNPlaceHolder/ValidateRecord';
            $data["payload"] = $data["Record"];

            return $this->httpRequest->trigger($data);

        } catch(\Exception $error){
            return $error.message();
        }
    }

    public function ValidateRecords($data){
        try{
            $data["path"] = '/nibss/BVNPlaceHolder/ValidateRecords';
            $data["payload"] = $data["Records"];

            return $this->httpRequest->trigger($data);

        } catch(\Exception $error){
            return $error.message();
        }
    }
}