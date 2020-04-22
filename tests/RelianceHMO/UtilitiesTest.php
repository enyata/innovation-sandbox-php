<?php
require_once './tests/Mock/RelianceHMO.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use \InnovationSandbox\RelianceHMO\Utilities;

class UtilitiesTest extends TestCase
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
        $this->apiClient = new Utilities($httpClient);
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

        $result = json_decode($this->apiClient->Providers($data));
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

        $result = json_decode($this->apiClient->Providers($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unauthorized. Please check your credentials.', $result->error);
        $this->assertEquals('401', $result->statusCode);
    }

    public function testShouldReturnErrorIfWrongProviderPayload()
    {
        $data = $this->mock->ProvidersRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->WrongPayloadResponse()
            )
        ));
        $data['params']['state'] = '';
        $result = json_decode($this->apiClient->Providers($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unmatched Request, Refer to documentation.', $result->error->Message);
        $this->assertEquals('05', $result->error->ResponseCode);
        $this->assertEquals('400', $result->statusCode);
    }

    public function testShouldReturnAvailableHealthCareProviders()
    {
        $data = $this->mock->ProvidersRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->ProvidersResponse()
            )
        ));

        $result = json_decode($this->apiClient->Providers($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertEquals('success', $result->data->status);
    }

    public function testShouldReturnAvailableHealthCareStates()
    {
        $data = $this->mock->StatesRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->StatesResponse()
            )
        ));

        $result = json_decode($this->apiClient->States($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertEquals('success', $result->data->status);
    }

    public function testShouldReturnAvailableHealthCareBenefits()
    {
        $data = $this->mock->BenefitsRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->BenefitsResponse()
            )
        ));

        $result = json_decode($this->apiClient->Benefits($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertEquals('success', $result->data->status);
    }

    public function testShouldReturnErrorIfWrongBenefitsPayload()
    {
        $data = $this->mock->BenefitsRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->WrongPayloadResponse()
            )
        ));
        $data['params']['plan'] = '';
        $result = json_decode($this->apiClient->Benefits($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unmatched Request, Refer to documentation.', $result->error->Message);
        $this->assertEquals('05', $result->error->ResponseCode);
        $this->assertEquals('400', $result->statusCode);
    }

    public function testShouldReturnAvailableEnrolleeTitiles()
    {
        $data = $this->mock->TitlesRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->TitlesResponse()
            )
        ));

        $result = json_decode($this->apiClient->Titles($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertEquals('success', $result->data->status);
    }

    public function testShouldReturnOccupations()
    {
        $data = $this->mock->OccupationsRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->OccupationsResponse()
            )
        ));

        $result = json_decode($this->apiClient->Occupations($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertEquals('success', $result->data->status);
    }

    public function testShouldReturnMaritalStatuses()
    {
        $data = $this->mock->MaritalStatusesRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->MaritalStatusesResponse()
            )
        ));

        $result = json_decode($this->apiClient->Statuses($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertEquals('success', $result->data->status);
    }
}
