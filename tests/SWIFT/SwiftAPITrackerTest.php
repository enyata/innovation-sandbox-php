<?php
require_once './tests/Mock/Swift.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use \InnovationSandbox\SWIFT\SwiftAPITracker;

class SwiftAPITrackerTest extends TestCase
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
        $this->apiClient = new SwiftAPITracker($httpClient);
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

        $result = json_decode($this->apiClient->Status($data));
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

        $result = json_decode($this->apiClient->Status($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unauthorized. Please check your credentials.', $result->error);
        $this->assertEquals('401', $result->statusCode);
    }

    public function testShouldReturnErrorIfWrongStatusPayload()
    {
        $data = $this->mock->StatusRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->WrongPayloadResponse()
            )
        ));
        $data['access_token'] = '';
        $result = json_decode($this->apiClient->Status($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unmatched Request, Refer to documentation.', $result->error->Message);
        $this->assertEquals('05', $result->error->ResponseCode);
        $this->assertEquals('400', $result->statusCode);
    }

    public function testShouldConfirmStatus()
    {
        $data = $this->mock->StatusRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->StatusResponse()
            )
        ));

        $result = json_decode($this->apiClient->Status($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertEquals('OK', $result->data->Status);
    }

    public function testShouldReturnTransactionsDetails()
    {
        $data = $this->mock->TransactionsRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->TransactionsResponse()
            )
        ));

        $result = json_decode($this->apiClient->Transactions($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertEquals('ACCC', $result->data->transaction_status);
    }

    public function testShouldReturnCancellationStatus()
    {
        $data = $this->mock->CancellationRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->CancellationResponse()
            )
        ));

        $result = json_decode($this->apiClient->Cancellation($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertEquals('OK', $result->data->Status);
    }
    
}
