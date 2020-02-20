<?php

namespace InnovationSandbox\NIBSS;

use InnovationSandbox\NIBSS\Common\ModuleRequest;
use GuzzleHttp\Client;

class FingerPrint {
private $httpRequest;

    public function __construct(Client $client = null){
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function VerifyFingerPrint($data){
        try{
            $data["path"] = '/nibss/fp/VerifyFingerPrint';
            $data["payload"] = $data["fingerPrintData"];

            return $this->httpRequest->trigger($data);

        } catch(\Exception $error){
            return $error.message();
        }
    }
}