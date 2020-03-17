<?php

require_once './tests/Fixtures/Atlabs.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use \InnovationSandbox\Atlabs\Token;

class TokenTest extends TestCase{

    private $mockHandler, 
            $apiClient,
            $base_uri,
            $faker,
            $fixture;
    
    public function setUp(){
        parent::setUp();
        $this->faker = Faker\Factory::create();
        $this->base_url = $this->faker->freeEmailDomain();
        $this->mockHandler = new MockHandler();
        $httpClient = new Client([
            'handler' => $this->mockHandler,
            'base_uri' => $this->base_uri
        ]);
        $this->apiClient = new Token($httpClient);
        $this->fixture = new Atlabs();
    }

    public function testShouldSendAirtime(){
        $data = $this->fixture->CheckoutTokenRequest();
        $this->mockHandler->append(new Response(
            200, 
            [], 
            json_encode($this->fixture->CheckoutTokenResponse()
        )));

        $result = json_decode($this->apiClient->CheckoutToken('', $data['sandbox_key'], $data['payload']));
        $this->assertObjectHasAttribute('description', $result);
        $this->assertObjectHasAttribute('token', $result);
        $this->assertEquals('Success', $result->description);
    }

}