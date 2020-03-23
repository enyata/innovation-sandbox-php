<?php

require_once './tests/Mock/Atlabs.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use \InnovationSandbox\Atlabs\Voice;

class VoiceTest extends TestCase
{

    private $mockHandler,
        $apiClient,
        $base_uri,
        $faker,
        $fixture;

    public function setUp()
    {
        parent::setUp();
        $this->faker = Faker\Factory::create();
        $this->base_url = $this->faker->freeEmailDomain();
        $this->mockHandler = new MockHandler();
        $httpClient = new Client([
            'handler' => $this->mockHandler,
            'base_uri' => $this->base_uri
        ]);
        $this->apiClient = new Voice($httpClient);
        $this->mock = new Atlabs();
    }

    public function testShouldInitiateVoiceCall()
    {
        $data = $this->mock->InitiateVoiceCallRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->InitiateVoiceCallResponse()
            )
        ));

        $result = json_decode($this->apiClient->Call('', $data['sandbox_key'], $data['payload']));
        $this->assertObjectHasAttribute('entries', $result);
    }

    public function testShouldFetchQueuedCalls()
    {
        $data = $this->mock->QueueStatusRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->QueueStatusResponse()
            )
        ));

        $result = json_decode($this->apiClient->QueueStatus('', $data['sandbox_key'], $data['payload']));
        $this->assertObjectHasAttribute('entries', $result);
        $this->assertObjectHasAttribute('status', $result);
    }

    public function testShouldUploadMediaFile()
    {
        $data = $this->mock->MediaUploadRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->MediaUploadResponse()
            )
        ));

        $result = json_decode($this->apiClient->MediaUpload('', $data['sandbox_key'], $data['payload']));
        $this->assertEquals('The request has been fulfilled and resulted in a new resource being created.', $result);
    }
}
