<?php
require_once './tests/Mock/RelianceHMO.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use \InnovationSandbox\RelianceHMO\Enrollees;

class EnrolleesTest extends TestCase
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
        $this->apiClient = new Enrollees($httpClient);
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

        $result = json_decode($this->apiClient->Register($data));
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

        $result = json_decode($this->apiClient->Register($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unauthorized. Please check your credentials.', $result->error);
        $this->assertEquals('401', $result->statusCode);
    }

    public function testShouldReturnErrorIfWrongEnrolleeRegistrationPayload()
    {
        $data = $this->mock->EnrolleeRegistrationRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->WrongPayloadResponse()
            )
        ));

        $result = json_decode($this->apiClient->Register($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unmatched Request, Refer to documentation.', $result->error->Message);
        $this->assertEquals('05', $result->error->ResponseCode);
        $this->assertEquals('400', $result->statusCode);
    }

    public function testShouldRegisterEnrollees()
    {
        $data = $this->mock->EnrolleeRegistrationRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->EnrolleeRegistrationResponse()
            )
        ));

        $result = json_decode($this->apiClient->Register($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertEquals('success', $result->data->status);
    }

    public function testShouldGetAllEnrollees()
    {
        $data = $this->mock->GetEnrolleesRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->GetEnrolleesResponse()
            )
        ));

        $result = json_decode($this->apiClient->GetEnrollees($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertEquals('success', $result->data->status);
    }

    public function testShouldGetSingleEnrollees()
    {
        $data = $this->mock->GetEnrolleeRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->GetEnrolleeResponse()
            )
        ));

        $result = json_decode($this->apiClient->GetEnrollee($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertEquals('success', $result->data->status);
    }

    public function testShouldCompleteEnrolleeProfile()
    {
        $data = $this->mock->EnrolleeProfileRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->EnrolleeProfileResponse()
            )
        ));

        $result = json_decode($this->apiClient->Profile($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertEquals('success', $result->data->status);
    }

    public function testShouldReturnErrorIfInvalidEnrolleeProfileData()
    {
        $data = $this->mock->EnrolleeProfileRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->WrongPayloadResponse()
            )
        ));
        $data['params']['home_address'] = '';
        $result = json_decode($this->apiClient->Profile($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unmatched Request, Refer to documentation.', $result->error->Message);
        $this->assertEquals('05', $result->error->ResponseCode);
        $this->assertEquals('400', $result->statusCode);
    }

    public function testShouldRetrieveEnrolleeDetails()
    {
        $data = $this->mock->ValidateEnrolleeRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->ValidateEnrolleeResponse()
            )
        ));

        $result = json_decode($this->apiClient->Validate($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertEquals('success', $result->data->status);
    }

    public function testShouldReturnErrorIfInvalidEnrolleeValidationData()
    {
        $data = $this->mock->ValidateEnrolleeRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->WrongPayloadResponse()
            )
        ));
        $data['params']['hmo_id'] = '';
        $result = json_decode($this->apiClient->Validate($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unmatched Request, Refer to documentation.', $result->error->Message);
        $this->assertEquals('05', $result->error->ResponseCode);
        $this->assertEquals('400', $result->statusCode);
    }

    public function testShouldRetrieveEnrolleeCardImage()
    {
        $data = $this->mock->EnrolleeCardRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->EnrolleeCardResponse()
            )
        ));

        $result = json_decode($this->apiClient->Card($data));
        $this->assertObjectHasAttribute('message', $result);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertEquals('OK', $result->message);
        $this->assertEquals('success', $result->data->status);
    }

    public function testShouldReturnErrorIfInvalidEnrolleeCardData()
    {
        $data = $this->mock->EnrolleeCardRequest();
        $this->mockHandler->append(new Response(
            200,
            [],
            json_encode(
                $this->mock->WrongPayloadResponse()
            )
        ));
        $data['params']['hmo_id'] = '';
        $result = json_decode($this->apiClient->Card($data));
        $this->assertObjectHasAttribute('error', $result);
        $this->assertObjectHasAttribute('statusCode', $result);
        $this->assertEquals('Unmatched Request, Refer to documentation.', $result->error->Message);
        $this->assertEquals('05', $result->error->ResponseCode);
        $this->assertEquals('400', $result->statusCode);
    }
}
