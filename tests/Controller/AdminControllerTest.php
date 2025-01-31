<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testAdminPageAccess(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin');

        $this->assertResponseStatusCodeSame(403);
    }
}
