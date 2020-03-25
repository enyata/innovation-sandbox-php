<?php

require_once './tests/Mock/Atlabs.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use \InnovationSandbox\Atlabs\SMS;

class SMSTest extends TestCase
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
        $this->apiClient = new SMS($httpClient);
        $this->mock = new Atlabs();
    }

    public function testShouldSendSMS()
    {
        $data = $this->mock->SMSServiceRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->SMSServiceResponse()
            )
        ));
        $result = json_decode($this->apiClient->SMSService('', $data['sandbox_key'], $data['payload']));
        $this->assertObjectHasAttribute('SMSMessageData', $result);
        $this->assertObjectHasAttribute('Recipients', $result->SMSMessageData);
        $this->assertObjectHasAttribute('Message', $result->SMSMessageData);
        $this->assertEquals('Success', $result->SMSMessageData->Recipients[0]->status);
    }

    public function testShouldReturnErrorIfSMSServicePayloadError()
    {
        $data = $this->mock->SMSServiceRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->SMSServicePayloadErrorResponse()
            )
        ));
        $result = json_decode($this->apiClient->SMSService('', $data['sandbox_key'], ''));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals(400, $result->statusCode);
    }

    public function testShouldReturnErrorIfInvalidSender()
    {
        $data = $this->mock->SMSServiceRequest();
        $data['payload']['from'] = '000000';
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->InvalidSMSServiceSenderErrorResponse()
            )
        ));
        $result = json_decode($this->apiClient->SMSService('', $data['sandbox_key'], $data['payload']));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals(400, $result->statusCode);
    }

    public function testShouldSendPremiumSMS()
    {
        $data = $this->mock->PremiumSMSRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->PremiumSMSResponse()
            )
        ));
        $result = json_decode($this->apiClient->Premium('', $data['sandbox_key'], $data['payload']));
        $this->assertObjectHasAttribute('SMSMessageData', $result);
        $this->assertObjectHasAttribute('Recipients', $result->SMSMessageData);
        $this->assertObjectHasAttribute('Message', $result->SMSMessageData);
        $this->assertEquals('Success', $result->SMSMessageData->Recipients[0]->status);
    }

    public function testShouldCreatePremiumSubscription()
    {
        $data = $this->mock->CreatePremiumRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->CreatePremiumResponse()
            )
        ));
        $result = json_decode($this->apiClient->CreatePremium('', $data['sandbox_key'], $data['payload']));
        $this->assertObjectHasAttribute('status', $result);
        $this->assertObjectHasAttribute('description', $result);
        $this->assertEquals('Success', $result->status);
    }

    public function testShouldReturErrorIfInvalidToken()
    {
        $data = $this->mock->CreatePremiumRequest();
        $data['payload']['checkoutToken'] = 'something';
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->InvalidTokenErrorResponse()
            )
        ));
        $result = json_decode($this->apiClient->CreatePremium('', $data['sandbox_key'], $data['payload']));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('description', $result->error);
        $this->assertEquals('Invalid token provided', $result->error->description);
    }

    public function testShouldDeletePremiumSubscription()
    {
        $data = $this->mock->DeletePremiumRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->DeletePremiumResponse()
            )
        ));
        $result = json_decode($this->apiClient->DeletePremium('', $data['sandbox_key'], $data['payload']));
        $this->assertObjectHasAttribute('status', $result);
        $this->assertObjectHasAttribute('description', $result);
        $this->assertEquals('Success', $result->status);
    }

    public function testShouldFetchPremiumSubscription()
    {
        $data = $this->mock->FetchPremiumRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->FetchPremiumResponse()
            )
        ));
        $result = json_decode($this->apiClient->FetchPremium('', $data['sandbox_key'], $data['payload']));
        $this->assertObjectHasAttribute('responses', $result);
    }

    public function testShouldFetchMessages()
    {
        $data = $this->mock->FetchMessagesRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->FetchMessagesResponse()
            )
        ));
        $result = json_decode($this->apiClient->FetchMessages('', $data['sandbox_key'], $data['payload']));
        $this->assertObjectHasAttribute('SMSMessageData', $result);
        $this->assertObjectHasAttribute('Messages', $result->SMSMessageData);
    }
}
