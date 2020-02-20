<?php

namespace InnovationSandbox\NIBSS;

use InnovationSandbox\NIBSS\Common\ModuleRequest;
use GuzzleHttp\Client;

class Bvnr {
private $httpRequest, $client;

    public function __construct(Client $client = null){
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function Reset($data){
        try{
            $data['path'] = '/nibss/bvnr/Reset';
            return $this->httpRequest->trigger($data);

        } catch(\Exception $error){
            return $error->getMessage();
        }
    }

    public function VerifySingleBVN($data){
        try{
            $data['path'] = '/nibss/bvnr/VerifySingleBVN';
            $data['payload'] = ['BVN' => $data['bvn']];

            return $this->httpRequest->trigger($data);

        } catch(\Exception $error){
            return $error.message();
        }
    }

    public function VerifyMultipleBVN($data){
        try{
            $data['path'] = '/nibss/bvnr/VerifyMultipleBVN';
            $data['payload'] = ['BVNS' => $data['bvn']];

            return $this->httpRequest->trigger($data);

        } catch(\Exception $error){
            return $error.message();
        }
    }

    public function GetSingleBVN($data){
        try{
            $data['path'] = '/nibss/bvnr/GetSingleBVN';
            $data['payload'] = ['BVN' => $data['bvn']];

            return $this->httpRequest->trigger($data);

        } catch(\Exception $error){
            return $error.message();
        }
    }

    public function GetMultipleBVN($data){
        try{
            $data['path'] = '/nibss/bvnr/GetMultipleBVN';
            $data['payload'] = ['BVNS' => $data['bvn']];

            return $this->httpRequest->trigger($data);

        } catch(\Exception $error){
            return $error.message();
        }
    }

    public function IsBVNWatchlisted($data){
        try{
            $data['path'] = '/nibss/bvnr/IsBVNWatchlisted';
            $data['payload'] = ['BVN' => $data['bvn']];

            return $this->httpRequest->trigger($data);

        } catch(\Exception $error){
            return $error.message();
        }
    }
}