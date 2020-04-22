<?php
require_once './tests/Mock/RelianceHMO.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use \InnovationSandbox\RelianceHMO\Retails;

class RetailTest extends TestCase
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
        $this->apiClient = new Retails($httpClient);
        $this->mock = new RelianceHMO();
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

        $result = json_decode($this->apiClient->Signup($data));
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
        $bvnData['sandbox_key'] = '';

        $result = json_decode($this->apiClient->Signup($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unauthorized. Please check your credentials.', $result->error);
        $this->assertEquals('401', $result->statusCode);
    }

    public function testShouldReturnErrorIfWrongSignupPayload()
    {
        $data = $this->mock->RetailSignupRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->WrongPayloadResponse()
            )
        ));
        $data['payload']['Referral_code'] = '';
        $result = json_decode($this->apiClient->Signup($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unmatched Request, Refer to documentation.', $result->error->Message);
        $this->assertEquals('05', $result->error->ResponseCode);
        $this->assertEquals('400', $result->statusCode);
    }

    public function testShouldCreateIndividualAccount()
    {
        $data = $this->mock->RetailSignupRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->RetailSignupResponse()
            )
        ));

        $result = json_decode($this->apiClient->Signup($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertEquals('success', $result->data->status);
    }

    public function testShouldReturnErrorIfInvalidRenewPayload()
    {
        $data = $this->mock->RenewRetailSubscriptionRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->WrongPayloadResponse()
            )
        ));
        
        $data['payload'] = '';
        $result = json_decode($this->apiClient->Renew($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unmatched Request, Refer to documentation.', $result->error->Message);
        $this->assertEquals('05', $result->error->ResponseCode);
        $this->assertEquals('400', $result->statusCode);
    }

    public function testShouldRenewSubscription()
    {
        $data = $this->mock->RenewRetailSubscriptionRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->RenewRetailSubscriptionResponse()
            )
        ));

        $result = json_decode($this->apiClient->Renew($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertEquals('success', $result->data->status);
    }
}
