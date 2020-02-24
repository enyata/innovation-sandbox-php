<?php

namespace InnovationSandbox\Sterling;

use GuzzleHttp\Client;
use InnovationSandbox\Sterling\Common\ModuleRequest;

class Transfer {
private $httpRequest, $client;

    public function __construct(Client $client = null){
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function InterbankNameEnquiry($data){
        try{
            $data['path'] = '/sterling/TransferAPIs/api/Spay/InterbankNameEnquiry';

            return $this->httpRequest->trigger('', 'GET', '', $data['params'], $data);
        } catch(\Exception $error){
            return $error->getMessage();
        }
    }
    
}