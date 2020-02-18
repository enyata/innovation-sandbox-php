<?php

namespace InnovationSandbox\NIBSS;

use InnovationSandbox\Common\HttpRequest;

class FingerPrint {
private $httpRequest;

    public function __construct(){
        $this->httpRequest = new HttpRequest;
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