<?php

require_once './tests/Fixtures/Atlabs.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use \InnovationSandbox\Atlabs\Airtime;

class AirtimeTest extends TestCase{

    private $mockHandler, 
            $apiClient,
            $base_uri,
            $faker,
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
        $this->apiClient = new Airtime($httpClient);
        $this->fixture = new Atlabs();
    }

    public function testShouldSendAirtime(){
        $data = $this->fixture->SendAirtimeRequest();
        $this->mockHandler->append(new Response(
            200, 
            [], 
            json_encode($this->fixture->SendAirtimeResponse()
        )));
        
        $result = json_decode($this->apiClient->SendAirtime('', $data['sandbox_key'], $data['payload']));
        $this->assertObjectHasAttribute('description', $result);
        $this->assertObjectHasAttribute('token', $result);
        $this->assertEquals('Success', $result->description);
    }

    public function testShouldReturnErrorIfNoKey(){
        $this->mockHandler->append(new Response(
            200, 
            [], 
            json_encode($this->fixture->KeyErrorResponse()
        )));

        $result = json_decode($this->apiClient->SendAirtime('', '', ''));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals(401, $result->statusCode);
    }

    public function testShouldReturnErrorIfInvalidKey(){
        $this->mockHandler->append(new Response(
            200, 
            [], 
            json_encode($this->fixture->InvalidKeyErrorResponse()
        )));

        $result = json_decode($this->apiClient->SendAirtime('', 'dgfdhfhgfgh', ''));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals(403, $result->statusCode);
    }

    public function testShouldReturnErrorIfEmptyOrInvalidPayload(){
        $data = $this->fixture->SendAirtimeRequest();
        $this->mockHandler->append(new Response(
            200, 
            [], 
            json_encode($this->fixture->AirtimePayloadErrorResponse()
        )));

        $result = json_decode($this->apiClient->SendAirtime('', $data['sandbox_key']));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals(400, $result->statusCode);
    }

}