<?php

namespace Models;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

include 'config/const.php';

class UserTest extends TestCase
{
    private $user;
    private $connect;
    private $path;
    private $http;
 
    protected function setUp(): void
    {
        $this->user = new User();
        $this->connect = new Connect();
        $this->path = trim(PATH_CONF, '/');
        $this->http = new Client(['base_uri' => 'http://localhost:8000']);
    }
 
    protected function tearDown(): void
    {
        $this->user = NULL;
        $this->connect = NULL;
        $this->path = NULL;
        $this->http = null;
    }

    public function testCreateRouter(): void
    {
        $this->assertContainsOnlyInstancesOf(
            User::class,
            [new User, new InputCleaning]
        );
    }

    public function testSaveUser(): void
    {
        $result = $this->user->saveUser($this->connect, 'phpunit', 'test', $this->path);
        $this->assertTrue($result, $message = 'not preserved');
    }

    public function testAuthUser(): void
    {
        $result = $this->user->authUser($this->connect, '123', '321', $this->path);
        $this->assertTrue($result, $message = 'not preserved');
    }

    public function testLogout(): void
    {
        $response = $this->http->request('GET', '/logout');
        $resp = $response->getHeaders();
        $type = $resp['Content-type'][0];
        $this->assertEquals('text/html; charset=UTF-8', $type);
    }
}
      