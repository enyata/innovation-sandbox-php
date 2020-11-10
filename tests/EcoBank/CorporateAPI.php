<?php
require_once './tests/Mock/EcoBank.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use \InnovationSandbox\EcoBank\CorporateAPI;

class CorporateAPITest extends TestCase
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
        $this->apiClient = new CorporateAPI($httpClient);
        $this->mock = new EcoBank();
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
        $data['sandbox_key'] = 'invalid';

        $result = json_decode($this->apiClient->GenerateToken($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Expired/Invalid Sandbox Key.', $result->error);
        $this->assertEquals('403', $result->statusCode);
    }

    public function testShouldReturnErrorIfWrongPayload()
    {
        $data = $this->mock->GenerateTokenRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->WrongPayloadResponse()
            )
        ));
        $data['header'] = '';

        $result = json_decode($this->apiClient->GenerateToken($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unmatched Request, Refer to documentation.', $result->error->Message);
        $this->assertEquals('05', $result->error->ResponseCode);
        $this->assertEquals('400', $result->statusCode);
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

        $result = json_decode($this->apiClient->GenerateToken($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unauthorized. Please check your credentials.', $result->error);
        $this->assertEquals('401', $result->statusCode);
    }

    public function testShouldGenerateTokens()
    {
        $data = $this->mock->GenerateTokenRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->GenerateTokenResponse()
            )
        ));

        $result = json_decode($this->apiClient->GenerateToken($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldMakeCardPayment()
    {
        $data = $this->mock->CardPaymentRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->CardPaymentResponse()
            )
        ));

        $result = json_decode($this->apiClient->CardPayment($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldMakeMomoPayment()
    {
        $data = $this->mock->MomoPaymentRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->MomoPaymentResponse()
            )
        ));

        $result = json_decode($this->apiClient->MomoPayment($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldGetMCC()
    {
        $data = $this->mock->MCCRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->MCCResponse()
            )
        ));

        $result = json_decode($this->apiClient->MCC($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldCreateQR()
    {
        $data = $this->mock->CreateQRRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->CreateQRResponse()
            )
        ));

        $result = json_decode($this->apiClient->CreateQR($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldGenerateQR()
    {
        $data = $this->mock->QRRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->QRResponse()
            )
        ));

        $result = json_decode($this->apiClient->QR($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldViewAccountStatement()
    {
        $data = $this->mock->StatementRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->StatementResponse()
            )
        ));

        $result = json_decode($this->apiClient->Statement($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldMakePayment()
    {
        $data = $this->mock->PaymentRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->PaymentResponse()
            )
        ));

        $result = json_decode($this->apiClient->Payment($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }
}
