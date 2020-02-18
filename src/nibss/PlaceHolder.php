<?php

namespace InnovationSandbox\NIBSS;

use InnovationSandbox\Common\HttpRequest;

class PlaceHolder {
private $httpRequest;

    public function __construct(){
        $this->httpRequest = new HttpRequest;
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