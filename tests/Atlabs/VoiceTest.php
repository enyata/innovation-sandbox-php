<?php

require_once './tests/Fixtures/Atlabs.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use \InnovationSandbox\Atlabs\Voice;

class VoiceTest extends TestCase{

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
        $this->apiClient = new Voice($httpClient);
        $this->fixture = new Atlabs();
    }

    public function testShouldInitiateVoiceCall(){
        $data = $this->fixture->InitiateVoiceCallRequest();
        $this->mockHandler->append(new Response(
            200, 
            [], 
            json_encode($this->fixture->InitiateVoiceCallResponse()
        )));

        $result = json_decode($this->apiClient->Call('', $data['sandbox_key'], $data['payload']));
        $this->assertObjectHasAttribute('entries', $result);
    }

    public function testShouldFetchQueuedCalls(){
        $data = $this->fixture->QueueStatusRequest();
        $this->mockHandler->append(new Response(
            200, 
            [], 
            json_encode($this->fixture->QueueStatusResponse()
        )));

        $result = json_decode($this->apiClient->QueueStatus('', $data['sandbox_key'], $data['payload']));
        $this->assertObjectHasAttribute('entries', $result);
        $this->assertObjectHasAttribute('status', $result);
    }

    public function testShouldUploadMediaFile(){
        $data = $this->fixture->MediaUploadRequest();
        $this->mockHandler->append(new Response(
            200, 
            [], 
            json_encode($this->fixture->MediaUploadResponse()
        )));

        $result = json_decode($this->apiClient->MediaUpload('', $data['sandbox_key'], $data['payload']));
        $this->assertEquals('The request has been fulfilled and resulted in a new resource being created.', $result);
    }

}