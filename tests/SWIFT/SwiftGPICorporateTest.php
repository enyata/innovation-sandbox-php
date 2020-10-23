<?php
require_once './tests/Mock/Swift.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use \InnovationSandbox\SWIFT\SwiftGPICorporate;

class SwiftGPICorporateTest extends TestCase
{

    private $mockHandler,
        $apiClient,
        $base_uri,
        $faker;

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
        $this->apiClient = new SwiftGPICorporate($httpClient);
        $this->mock = new Swift();
    }

    public function testShouldReturnErrorIfInvalidKey()
    {
        $data = $this->mock->InvalidKeyRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->InvalidKeyResponse()
            )
        ));

        $result = json_decode($this->apiClient->Transactions($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Expired/Invalid Sandbox Key.', $result->error);
        $this->assertEquals('403', $result->statusCode);
    }

    public function testShouldReturnErrorIfNoKey()
    {
        $data = $this->mock->NoKeyRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->NoKeyResponse()
            )
        ));
        $data['sandbox_key'] = '';

        $result = json_decode($this->apiClient->Transactions($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unauthorized. Please check your credentials.', $result->error);
        $this->assertEquals('401', $result->statusCode);
    }

    public function testShouldReturnErrorIfWrongTransactionPayload()
    {
        $data = $this->mock->CorperateTransactionsRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->WrongPayloadResponse()
            )
        ));
        $data['access_token'] = '';
        $result = json_decode($this->apiClient->Transactions($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unmatched Request, Refer to documentation.', $result->error->Message);
        $this->assertEquals('05', $result->error->ResponseCode);
        $this->assertEquals('400', $result->statusCode);
    }

    public function testShouldReturnTransactionStatus()
    {
        $data = $this->mock->CorperateTransactionsRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->CorperateTransactionsResponse()
            )
        ));

        $result = json_decode($this->apiClient->Transactions($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertEquals('dXNlIHRoaXMgdmFsdWUgdG8gcmVxdWVzdCBuZXh0IHNldCBvZiBkYXRh', $result->data->next);
    }

    public function testShouldReturnInboundTransactionStatus()
    {
        $data = $this->mock->InboundRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->InboundResponse()
            )
        ));

        $result = json_decode($this->apiClient->Inbound($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertEquals(null, $result->data->next);
    }
    
}
