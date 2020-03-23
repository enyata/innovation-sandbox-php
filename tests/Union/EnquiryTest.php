<?php

require_once './tests/Mock/Union.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use \InnovationSandbox\Union\Enquiry;

class EnquiryTest extends TestCase
{

    private $mockHandler,
        $apiClient,
        $base_uri,
        $faker,
        $mock;

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
        $this->apiClient = new Enquiry($httpClient);
        $this->mock = new Union();
    }

    public function testShouldReturnErrorIfNoKey()
    {
        $data = $this->mock->AccountEnquiryRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->KeyErrorResponse()
            )
        ));

        $result = json_decode($this->apiClient->Account('', '', $data['payload'], ''));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('401', $result->statusCode);
    }

    public function testShouldReturnErrorIfInvalidKey()
    {
        $data = $this->mock->AccountEnquiryRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->InvalidKeyErrorResponse()
            )
        ));

        $result = json_decode($this->apiClient->Account('', 'somekey', $data['payload'], ''));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('403', $result->statusCode);
    }

    public function testShouldReturnErrorIfNoToken()
    {
        $data = $this->mock->AccountEnquiryRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->WrongPayloadErrorResponse()
            )
        ));

        $result = json_decode($this->apiClient->Account('', $data['sandbox_key'], $data['payload'], ''));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('400', $result->statusCode);
    }

    public function testShouldReturnErrorIfWrongPayload()
    {
        $data = $this->mock->AccountEnquiryRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->WrongPayloadErrorResponse()
            )
        ));

        $result = json_decode($this->apiClient->Account('', $data['sandbox_key'], [], $data['token']));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('400', $result->statusCode);
    }

    public function testShouldReturnAccountInformation()
    {
        $data = $this->mock->AccountEnquiryRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->AccountEnquiryResponse()
            )
        ));

        $result = json_decode($this->apiClient->Account('', $data['sandbox_key'], $data['payload'], $data['token']));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertObjectHasAttribute('code', $result->data);
        $this->assertEquals('00', $result->data->code);
    }

    public function testShouldReturnCustomerInformation()
    {
        $data = $this->mock->CustomerEnquiryRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->CustomerEnquiryResponse()
            )
        ));

        $result = json_decode($this->apiClient->Customer('', $data['sandbox_key'], $data['payload'], $data['token']));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertObjectHasAttribute('code', $result->data);
        $this->assertEquals('00', $result->data->code);
    }

    public function testShouldReturnCustomerAndAccountInformation()
    {
        $data = $this->mock->CustomerAndAccountEnquiryRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->CustomerAndAccountEnquiryResponse()
            )
        ));

        $result = json_decode($this->apiClient->CustomerAccount('', $data['sandbox_key'], $data['payload'], $data['token']));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertObjectHasAttribute('code', $result->data);
        $this->assertObjectHasAttribute('customer', $result->data);
        $this->assertObjectHasAttribute('account', $result->data);
        $this->assertObjectHasAttribute('message', $result->data);
        $this->assertEquals('00', $result->data->code);
        $this->assertEquals('Enquiry Successful', $result->data->message);
    }
}
