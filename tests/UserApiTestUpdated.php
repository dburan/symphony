<?php
use PHPUnit\Framework\TestCase;

class UserApiTest extends TestCase
{
    public function testCreateUser()
    {
        \$client = static::createClient();
        \$client->request('POST', '/api/user', [], [], ['CONTENT_TYPE' => 'application/json'], '{"name":"John Doe", "email":"john@example.com"}');
        \$this->assertEquals(201, \$client->getResponse()->getStatusCode());
        \$this->assertJson(\$client->getResponse()->getContent());
    }

    public function testGetUser()
    {
        \$client = static::createClient();
        \$client->request('GET', '/api/user/1');
        \$this->assertEquals(200, \$client->getResponse()->getStatusCode());
        \$this->assertJson(\$client->getResponse()->getContent());
    }

    public function testUpdateUser()
    {
        \$client = static::createClient();
        \$client->request('PUT', '/api/user/1', [], [], ['CONTENT_TYPE' => 'application/json'], '{"name":"John Doe Updated", "email":"john_updated@example.com"}');
        \$this->assertEquals(200, \$client->getResponse()->getStatusCode());
    }

    public function testDeleteUser()
    {
        \$client = static::createClient();
        \$client->request('DELETE', '/api/user/1');
        \$this->assertEquals(204, \$client->getResponse()->getStatusCode());
    }

    public function testInvalidUserId()
    {
        \$client = static::createClient();
        \$client->request('GET', '/api/user/9999');
        \$this->assertEquals(404, \$client->getResponse()->getStatusCode());
    }

    public function testCreateUserWithMissingFields()
    {
        \$client = static::createClient();
        \$client->request('POST', '/api/user', [], [], ['CONTENT_TYPE' => 'application/json'], '{"name":"Missing Email"}');
        \$this->assertEquals(400, \$client->getResponse()->getStatusCode());
    }

    public function testGetAllUsers()
    {
        \$client = static::createClient();
        \$client->request('GET', '/api/users');
        \$this->assertEquals(200, \$client->getResponse()->getStatusCode());
        \$this->assertJson(\$client->getResponse()->getContent());
    }

    public function testCreateUserWithInvalidEmail()
    {
        \$client = static::createClient();
        \$client->request('POST', '/api/user', [], [], ['CONTENT_TYPE' => 'application/json'], '{"name":"Invalid Email", "email":"invalid-email"}');
        \$this->assertEquals(400, \$client->getResponse()->getStatusCode());
    }

    public function testGetUserWithAuth()
    {
        \$client = static::createClient();
        \$client->request('GET', '/api/user/1', [], [], ['HTTP_AUTHORIZATION' => 'Bearer token']);
        \$this->assertEquals(200, \$client->getResponse()->getStatusCode());
    }

    public function testCreateUserWithAuthorization()
    {
        \$client = static::createClient();
        \$client->request('POST', '/api/user', [], [], ['HTTP_AUTHORIZATION' => 'Bearer token', 'CONTENT_TYPE' => 'application/json'], '{"name":"John With Token", "email":"token_user@example.com"}');
        \$this->assertEquals(201, \$client->getResponse()->getStatusCode());
    }
}
