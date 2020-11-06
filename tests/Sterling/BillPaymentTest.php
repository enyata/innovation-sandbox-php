<?php

require_once './tests/Mock/Sterling.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use \InnovationSandbox\Sterling\BillPayment;

class BillPaymentTest extends TestCase
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
        $this->apiClient = new BillPayment($httpClient);
        $this->mock = new Sterling();
    }

    public function testShouldReturnErrorIfInvalidKey()
    {
        $data = $this->mock->InvalidKeyRequest();
        $this->mockHandler->append(new Response(
            403,
            [],
            json_encode(
                $this->mock->InvalidKeyResponse()
            )
        ));
        $result = json_decode($this->apiClient->BillersPaymentItems($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Expired/Invalid Sandbox Key.', $result->error);
        $this->assertEquals('403', $result->statusCode);
    }

    public function testShouldReturnErrorIfNoKey()
    {
        $data = $this->mock->NoKeyRequest();
        $this->mockHandler->append(new Response(
            401,
            [],
            json_encode(
                $this->mock->NoKeyResponse()
            )
        ));
        $bvnData['sandbox_key'] = '';

        $result = json_decode($this->apiClient->BillersPaymentItems($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unauthorized. Please check your credentials.', $result->error);
        $this->assertEquals('401', $result->statusCode);
    }

    public function testShouldReturnErrorIfWrongPayload()
    {
        $data = $this->mock->mobileWalletRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->WrongPayloadResponse()
            )
        ));
        $data['payload']['tellerid'] = '';
        $result = json_decode($this->apiClient->BillersPaymentItems($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unmatched Request, Refer to documentation.', $result->error->Message);
        $this->assertEquals('05', $result->error->ResponseCode);
        $this->assertEquals('400', $result->statusCode);
    }

    public function testShouldGetBillersPaymentItems()
    {
        $data = $this->mock->GetBillerPmtItemsRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->GetBillerPmtItemsResponse()
            )
        ));

        $result = json_decode($this->apiClient->BillersPaymentItems($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('200 OK', $result->data->Status);
        $this->assertEquals('Message sent was successful', $result->data->Message);
    }

    public function testShouldGetBillersISW()
    {
        $data = $this->mock->GetBillersISWRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->GetBillersISWResponse()
            )
        ));

        $result = json_decode($this->apiClient->BillersISW($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('200 OK', $result->data->Status);
        $this->assertEquals('Message sent was successful', $result->data->Message);
    }

    public function testShouldInitiateBillPaymtAdviceRequestISW()
    {
        $data = $this->mock->BillPaymtAdviceRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->BillPaymtAdviceResponse()
            )
        ));

        $result = json_decode($this->apiClient->BillPaymentAdvice($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('200 OK', $result->data->Status);
        $this->assertEquals('Message sent was successful', $result->data->Message);
    }
}
