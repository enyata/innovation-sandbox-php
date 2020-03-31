<?php
require_once './tests/Mock/Sterling.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use \InnovationSandbox\Sterling\Account;

class AccountTest extends TestCase
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
        $this->apiClient = new Account($httpClient);
        $this->mock = new Sterling();
    }

    public function testShouldReturnErrorIfInvalidKey()
    {
        $bvnData = $this->mock->interbankRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->InvalidKeyErrorResponse()
            )
        ));
        $bvnData['sandbox_key'] = 'invalid';

        $result = json_decode($this->apiClient->InterbankTransferReq($bvnData));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Expired/Invalid Sanbox Key.', $result->error);
        $this->assertEquals('403', $result->statusCode);
    }

    public function testShouldReturnErrorIfWrongPayload()
    {
        $bvnData = $this->mock->interbankRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->WrongPayloadErrorResponse()
            )
        ));
        $bvnData['subscription_key'] = '';

        $result = json_decode($this->apiClient->InterbankTransferReq($bvnData));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unmatched Request, Refer to documentation.', $result->error->Message);
        $this->assertEquals('05', $result->error->ResponseCode);
        $this->assertEquals('400', $result->statusCode);
    }

    public function testShouldReturnErrorIfNoKey()
    {
        $bvnData = $this->mock->interbankRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->KeyErrorResponse()
            )
        ));
        $bvnData['sandbox_key'] = '';

        $result = json_decode($this->apiClient->InterbankTransferReq($bvnData));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unauthorized. Please check your credentials.', $result->error);
        $this->assertEquals('401', $result->statusCode);
    }

    public function testShouldVerifyTransfer()
    {
        $bvnData = $this->mock->interbankRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->interbankResponse()
            )
        ));

        $result = json_decode($this->apiClient->InterbankTransferReq($bvnData));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertEquals('00', $result->data->data->status);
    }
}
