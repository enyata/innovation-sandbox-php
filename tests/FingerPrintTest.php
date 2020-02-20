<?php

require_once 'Fixture.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use InnovationSandbox\NIBSS\FingerPrint;
use BlastCloud\Guzzler\UsesGuzzler;
use GuzzleHttp\Middleware;
use InnovationSandbox\NIBSS\Common\Hash; 

class FingerPrintTest extends TestCase{

    private $mockHandler, 
            $handlerStack, 
            $apiClient,
            $aes_key,
            $ivkey,
            $password,
            $base_uri,
            $faker,
            $hash,
            $fixture;
    
    public function setUp(){
        parent::setUp();
        $this->faker = Faker\Factory::create();
        $this->base_url = $this->faker->freeEmailDomain();
        $this->mockHandler = new MockHandler();
        $httpClient = new Client([
            'handler' => $this->mockHandler,
            'base_uri' => $this->base_uri
        ]);
        $this->apiClient = new FingerPrint($httpClient);
        $this->fixture = new Fixture();
        $this->hash = new Hash();
    }

    public function testShouldVerifyFingerPrint(){
        $bvnData = $this->fixture->fingerPrintRequest();
        $encrypted = $this->hash->encrypt(json_encode($this->fixture->fingerPrintResponse()), $bvnData['aes_key'], $bvnData['ivkey']);
        $this->mockHandler->append(new Response(200, [], $encrypted));
        $result = $this->apiClient->VerifyFingerPrint($bvnData);
        $this->assertArrayHasKey('message', $result);
        $this->assertArrayHasKey('data', $result);
        $this->assertEquals('OK', $result['message']);
        $this->assertEquals('00', $result['data']['ResponseCode']);
    }

}