<?php

namespace InnovationSandbox\NIBSS;

use GuzzleHttp\Client;
use InnovationSandbox\NIBSS\Common\ModuleRequest;

class Bvnr
{
    private $httpRequest, $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ? $client : new Client();
        $this->httpRequest = new ModuleRequest($this->client);
    }

    public function Reset($data)
    {
        try {
            $data['path'] = '/nibss/bvnr/Reset';
            $data['method'] = 'POST';

            return $this->httpRequest->trigger($data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function VerifySingleBVN($data)
    {
        try {
            $data['path'] = '/nibss/bvnr/VerifySingleBVN';
            $data['payload'] = ['BVN' => $data['bvn']];
            $data['method'] = 'POST';

            return $this->httpRequest->trigger($data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function VerifyMultipleBVN($data)
    {
        try {
            $data['path'] = '/nibss/bvnr/VerifyMultipleBVN';
            $data['payload'] = ['BVNS' => $data['bvn']];
            $data['method'] = 'POST';

            return $this->httpRequest->trigger($data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function GetSingleBVN($data)
    {
        try {
            $data['path'] = '/nibss/bvnr/GetSingleBVN';
            $data['payload'] = ['BVN' => $data['bvn']];
            $data['method'] = 'POST';

            return $this->httpRequest->trigger($data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function GetMultipleBVN($data)
    {
        try {
            $data['path'] = '/nibss/bvnr/GetMultipleBVN';
            $data['payload'] = ['BVNS' => $data['bvn']];
            $data['method'] = 'POST';

            return $this->httpRequest->trigger($data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }

    public function IsBVNWatchlisted($data)
    {
        try {
            $data['path'] = '/nibss/bvnr/IsBVNWatchlisted';
            $data['payload'] = ['BVN' => $data['bvn']];
            $data['method'] = 'POST';
            return $this->httpRequest->trigger($data);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}
