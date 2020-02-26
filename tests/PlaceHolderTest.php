<?php

require_once './tests/Fixtures/Nibss.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use \InnovationSandbox\NIBSS\PlaceHolder;
use \InnovationSandbox\NIBSS\Common\Hash; 

class PlaceHolderTest extends TestCase{

    private $mockHandler, 
            $apiClient,
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
        $this->apiClient = new PlaceHolder($httpClient);
        $this->fixture = new Nibss();
        $this->hash = new Hash();
    }

    public function testShouldVerifyRecord(){
        $bvnData = $this->fixture->singleRecordRequest();
        $encrypted = $this->hash->encrypt(
            json_encode($this->fixture->singleRecordResponse()), 
            $bvnData['aes_key'], 
            $bvnData['ivkey']);

        $this->mockHandler->append(new Response(200, [], $encrypted));
        $result = $this->apiClient->ValidateRecord($bvnData);
        $this->assertArrayHasKey('message', $result);
        $this->assertArrayHasKey('data', $result);
        $this->assertEquals('OK', $result['message']);
        $this->assertEquals('00', $result['data']['ResponseCode']);
    }

    public function testShouldVerifyRecords(){
        $bvnData = $this->fixture->multipleRecordsRequest();
        $encrypted = $this->hash->encrypt(
            json_encode($this->fixture->multipleRecordsResponse()), 
            $bvnData['aes_key'], 
            $bvnData['ivkey']);

        $this->mockHandler->append(new Response(200, [], $encrypted));
        $result = $this->apiClient->ValidateRecords($bvnData);
        $this->assertArrayHasKey('message', $result);
        $this->assertArrayHasKey('data', $result);
        $this->assertArrayHasKey('ValidationResponses', $result['data']);
        $this->assertEquals('OK', $result['message']);
        $this->assertEquals('00', $result['data']['ValidationResponses'][0]['ResponseCode']);
    }

}