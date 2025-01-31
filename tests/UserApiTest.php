
<?php

use PHPUnit\Framework\TestCase;

class UserApiTest extends TestCase
{
    public function testCreateUser()
    {
        $client = static::createClient();
        $client->request('POST', '/api/user', [], [], ['CONTENT_TYPE' => 'application/json'], '{"name":"John Doe", "email":"john@example.com"}');

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testGetUser()
    {
        $client = static::createClient();
        $client->request('GET', '/api/user');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }
}
