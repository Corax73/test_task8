<?php

namespace Models;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
 
class RouterTest extends TestCase
{
    private $router;
    private $http;
 
    protected function setUp(): void
    {
        $this->router = new Router();
        $this->http = new Client(['base_uri' => 'http://localhost:8000']);
    }
 
    protected function tearDown(): void
    {
        $this->router = NULL;
        $this->http = null;
    }

    public function testCreateRouter(): void
    {
        $this->assertContainsOnlyInstancesOf(
            Router::class,
            [new Router, new InputCleaning]
        );
    }

    public function testGet(): void
    {
        $response = $this->http->request('GET', '/');
        $this->assertEquals(200, $response->getStatusCode());
        
        $resp = $response->getHeaders();
        $type = $resp['Content-type'][0];
        $this->assertEquals('text/html; charset=UTF-8', $type);
    }

    public function testContentType(): void
    {
        $response = $this->http->request('GET', '/');
        $resp = $response->getHeaders();
        $type = $resp['Content-type'][0];
        $this->assertEquals('text/html; charset=UTF-8', $type);
    }
    
    public function testPost(): void
    {
        $response = $this->http->request('POST', '/create', ['form_params' => ['username' => 'phpunit', 'email' => 'phpunit@mail.php', 'descriptions' => 'test']]);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
