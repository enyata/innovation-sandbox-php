<?php

require_once './tests/Mock/Nibss.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use \InnovationSandbox\NIBSS\Bvnr;
use \InnovationSandbox\NIBSS\Common\Hash;

class BvnrTest extends TestCase
{

    private $mockHandler,
        $apiClient,
        $base_uri,
        $faker,
        $hash,
        $fixture;

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
        $this->apiClient = new Bvnr($httpClient);
        $this->mock = new Nibss();
        $this->hash = new Hash();
    }

    public function testShouldReturnCredentials()
    {
        $head = $this->mock->ResetResponse();
        $this->mockHandler->append(new Response(200, $head));

        $result = $this->apiClient->Reset($this->mock->ResetRequest());

        $this->assertArrayHasKey('ivkey', $result);
        $this->assertArrayHasKey('password', $result);
        $this->assertArrayHasKey('aes_key', $result);
    }

    public function testShouldVerifySingleBVN()
    {
        $bvnData = $this->mock->singleBVNRequest();
        $encrypted = $this->hash->encrypt(
            json_encode($this->mock->singleBVNResponse()),
            $bvnData['aes_key'],
            $bvnData['ivkey']
        );

        $this->mockHandler->append(new Response(200, [], $encrypted));
        $result = $this->apiClient->VerifySingleBVN($bvnData);
        $this->assertArrayHasKey('message', $result);

        $this->assertArrayHasKey('data', $result);
        $this->assertEquals('OK', $result['message']);
        $this->assertEquals('00', $result['data']['ResponseCode']);
    }

    public function testShouldVerifyMultipleBVN()
    {
        $bvnData = $this->mock->multipleBVNRequest();
        $encrypted = $this->hash->encrypt(
            json_encode($this->mock->multipleBVNResponse()),
            $bvnData['aes_key'],
            $bvnData['ivkey']
        );

        $this->mockHandler->append(new Response(200, [], $encrypted));
        $result = $this->apiClient->VerifyMultipleBVN($bvnData);

        $this->assertArrayHasKey('message', $result);
        $this->assertArrayHasKey('data', $result);
        $this->assertEquals('OK', $result['message']);
        $this->assertEquals('00', $result['data']['ResponseCode']);
    }

    public function testShouldGetSingleBVN()
    {
        $bvnData = $this->mock->singleBVNRequest();
        $encrypted = $this->hash->encrypt(
            json_encode($this->mock->singleBVNResponse()),
            $bvnData['aes_key'],
            $bvnData['ivkey']
        );

        $this->mockHandler->append(new Response(200, [], $encrypted));
        $result = $this->apiClient->GetSingleBVN($bvnData);

        $this->assertArrayHasKey('message', $result);
        $this->assertArrayHasKey('data', $result);
        $this->assertEquals('OK', $result['message']);
        $this->assertEquals('00', $result['data']['ResponseCode']);
    }

    public function testShouldGetMultipleBVN()
    {
        $bvnData = $this->mock->multipleBVNRequest();
        $encrypted = $this->hash->encrypt(
            json_encode($this->mock->multipleBVNResponse()),
            $bvnData['aes_key'],
            $bvnData['ivkey']
        );

        $this->mockHandler->append(new Response(200, [], $encrypted));
        $result = $this->apiClient->GetMultipleBVN($bvnData);

        $this->assertArrayHasKey('message', $result);
        $this->assertArrayHasKey('data', $result);
        $this->assertArrayHasKey('ValidationResponses', $result['data']);
        $this->assertEquals('OK', $result['message']);
        $this->assertEquals('00', $result['data']['ResponseCode']);
    }

    public function testShouldCheckIfWatchListed()
    {
        $bvnData = $this->mock->singleBVNRequest();
        $encrypted = $this->hash->encrypt(
            json_encode($this->mock->watchListedBVNResponse()),
            $bvnData['aes_key'],
            $bvnData['ivkey']
        );

        $this->mockHandler->append(new Response(200, [], $encrypted));
        $result = $this->apiClient->IsBVNWatchlisted($bvnData);

        $this->assertArrayHasKey('message', $result);
        $this->assertArrayHasKey('data', $result);
        $this->assertEquals('OK', $result['message']);
        $this->assertEquals('00', $result['data']['ResponseCode']);
        $this->assertArrayHasKey('WatchListed', $result['data']);
    }
}
