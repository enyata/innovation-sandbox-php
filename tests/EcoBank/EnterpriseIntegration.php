<?php
require_once './tests/Mock/EcoBank.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use \InnovationSandbox\EcoBank\EnterpriseIntegration;

class EnterpriseIntegrationTest extends TestCase
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
        $this->apiClient = new EnterpriseIntegration($httpClient);
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

    public function testShouldMakeAccountNameEnquiry()
    {
        $data = $this->mock->AccountNameEnquiryRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->AccountNameEnquiryResponse()
            )
        ));

        $result = json_decode($this->apiClient->AccountNameEnquiry($data));
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

    public function testShouldMakeTransfer()
    {
        $data = $this->mock->TransferRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->TransferResponse()
            )
        ));

        $result = json_decode($this->apiClient->Transfer($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldGetTransactionStatus()
    {
        $data = $this->mock->TransactionStatusRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->TransactionStatusResponse()
            )
        ));

        $result = json_decode($this->apiClient->TransactionStatus($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldMakeAgentNameEnquiry()
    {
        $data = $this->mock->AgentNameEnquiryRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->AgentNameEnquiryResponse()
            )
        ));

        $result = json_decode($this->apiClient->AgentNameEnquiry($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldInitiateReceiveCash()
    {
        $data = $this->mock->InitiateReceiveCashRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->InitiateReceiveCashResponse()
            )
        ));

        $result = json_decode($this->apiClient->InitiateReceiveCash($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldCompleteReceive()
    {
        $data = $this->mock->CompleteReceiveRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->CompleteReceiveResponse()
            )
        ));

        $result = json_decode($this->apiClient->CompleteReceive($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldGetAgentTransactionStatus()
    {
        $data = $this->mock->AgentTransactionStatusRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->AgentTransactionStatusResponse()
            )
        ));

        $result = json_decode($this->apiClient->AgentTransactionStatus($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldMakeInternationalNameInquiry()
    {
        $data = $this->mock->InternationalNameInquiryRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->InternationalNameInquiryResponse()
            )
        ));

        $result = json_decode($this->apiClient->InternationalNameInquiry($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldPostTransfer()
    {
        $data = $this->mock->PostTransferRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->PostTransferResponse()
            )
        ));

        $result = json_decode($this->apiClient->PostTransfer($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldFetchRateFees()
    {
        $data = $this->mock->FetchRateFeesRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->FetchRateFeesResponse()
            )
        ));

        $result = json_decode($this->apiClient->FetchRateFees($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldFetchInstitutionsList()
    {
        $data = $this->mock->FetchInstitutionsListRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->FetchInstitutionsListResponse()
            )
        ));

        $result = json_decode($this->apiClient->FetchInstitutionsList($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldMakeInternationalTransactionStatus()
    {
        $data = $this->mock->InternationalTransactionStatusRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->InternationalTransactionStatusResponse()
            )
        ));

        $result = json_decode($this->apiClient->InternationalTransactionStatus($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }

    public function testShouldFetchRate()
    {
        $data = $this->mock->FetchRateRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->FetchRateResponse()
            )
        ));

        $result = json_decode($this->apiClient->FetchRate($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
    }
}
