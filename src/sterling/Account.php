<?php
namespace InnovationSandbox\Sterling;

use GuzzleHttp\Client;
use InnovationSandbox\Sterling\Common\ModuleRequest;

class Account {
    private $httpRequest, $client;

    public function __construct(Client $client = null){
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function InterbankTransferReq($data){
        try{
            $data['path'] = '/sterling/accountapi/api/Spay/InterbankTransferReq';
            $payload = isset($data['payload']) ? $data['payload'] : '';
            
            return $this->httpRequest->trigger('', 'POST', $payload, '', $data);
        } catch(\Exception $error){
            return $error->getMessage();
        }
    }
    
}