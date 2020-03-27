<?php

require_once './tests/Mock/Union.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use \InnovationSandbox\Union\Token;

class UnionTokenTest extends TestCase
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
        $this->apiClient = new Token($httpClient);
        $this->mock = new Union();
    }

    public function testShouldReturnErrorIfNoKey()
    {
        $data = $this->mock->TokenRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->KeyErrorResponse()
            )
        ));

        $result = json_decode($this->apiClient->GenerateToken('', '', $data['payload']));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('401', $result->statusCode);
    }

    public function testShouldReturnErrorIfInvalidKey()
    {
        $data = $this->mock->TokenRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->InvalidKeyErrorResponse()
            )
        ));

        $result = json_decode($this->apiClient->GenerateToken('', 'somekey', $data['payload']));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('403', $result->statusCode);
    }

    public function testShouldReturnErrorIfWrongPayload()
    {
        $data = $this->mock->TokenRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->WrongPayloadErrorResponse()
            )
        ));

        $result = json_decode($this->apiClient->GenerateToken('', $data['sandbox_key'], []));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('400', $result->statusCode);
    }

    public function testShouldReturnToken()
    {
        $data = $this->mock->TokenRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->TokenResponse()
            )
        ));

        $result = json_decode($this->apiClient->GenerateToken('', $data['sandbox_key'], $data['payload']));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertObjectHasAttribute('access_token', $result->data);
        $this->assertEquals('bearer', $result->data->token_type);
    }
}
