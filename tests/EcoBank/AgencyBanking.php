<?php
require_once './tests/Mock/EcoBank.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use \InnovationSandbox\EcoBank\AgencyBanking;

class AgencyBankingTest extends TestCase
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
        $this->apiClient = new AgencyBanking($httpClient);
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

        $result = json_decode($this->apiClient->AirtimeBillers($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Expired/Invalid Sandbox Key.', $result->error);
        $this->assertEquals('403', $result->statusCode);
    }

    public function testShouldReturnErrorIfWrongPayload()
    {
        $data = $this->mock->AirtimeBillersRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->WrongPayloadResponse()
            )
        ));
        $data['header'] = '';

        $result = json_decode($this->apiClient->AirtimeBillers($data));
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

        $result = json_decode($this->apiClient->AirtimeBillers($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unauthorized. Please check your credentials.', $result->error);
        $this->assertEquals('401', $result->statusCode);
    }

    public function testShouldGetAllAirtimeBillers()
    {
        $data = $this->mock->AirtimeBillersRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->AirtimeBillersResponse()
            )
        ));

        $result = json_decode($this->apiClient->AirtimeBillers($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldBuyAirtime()
    {
        $data = $this->mock->BuyAirtimeRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->BuyAirtimeResponse()
            )
        ));

        $result = json_decode($this->apiClient->BuyAirtime($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldGetBalance()
    {
        $data = $this->mock->BalanceRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->BalanceResponse()
            )
        ));

        $result = json_decode($this->apiClient->Balance($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldGetCustomerDetails()
    {
        $data = $this->mock->CustomerDetailsRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->CustomerDetailsResponse()
            )
        ));

        $result = json_decode($this->apiClient->CustomerDetails($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }
}
