<?php

namespace InnovationSandbox\NIBSS;

use InnovationSandbox\Common\HttpRequest;

class Bvnr {
private $httpRequest;

    public function __construct(){
        $this->httpRequest = new HttpRequest;
    }

    public function Reset($data){
        try{
            $data["path"] = '/nibss/bvnr/Reset';
            return $this->httpRequest->trigger($data);

        } catch(\Exception $error){
            return $error->getMessage();
        }
    }

    public function VerifySingleBVN($data){
        try{
            $data["path"] = '/nibss/bvnr/VerifySingleBVN';
            $data["payload"] = ["BVN" => $data["bvn"]];

            return $this->httpRequest->trigger($data);

        } catch(\Exception $error){
            return $error.message();
        }
    }

    public function VerifyMultipleBVN($data){
        try{
            $data["path"] = '/nibss/bvnr/VerifyMultipleBVN';
            $data["payload"] = ["BVNS" => $data["bvn"]];

            return $this->httpRequest->trigger($data);

        } catch(\Exception $error){
            return $error.message();
        }
    }

    public function GetSingleBVN($data){
        try{
            $data["path"] = '/nibss/bvnr/GetSingleBVN';
            $data["payload"] = ["BVN" => $data["bvn"]];

            return $this->httpRequest->trigger($data);

        } catch(\Exception $error){
            return $error.message();
        }
    }

    public function GetMultipleBVN($data){
        try{
            $data["path"] = '/nibss/bvnr/GetMultipleBVN';
            $data["payload"] = ["BVNS" => $data["bvn"]];

            return $this->httpRequest->trigger($data);

        } catch(\Exception $error){
            return $error.message();
        }
    }

    public function IsBVNWatchlisted($data){
        try{
            $data["path"] = '/nibss/bvnr/IsBVNWatchlisted';
            $data["payload"] = ["BVN" => $data["bvn"]];

            return $this->httpRequest->trigger($data);

        } catch(\Exception $error){
            return $error.message();
        }
    }
}