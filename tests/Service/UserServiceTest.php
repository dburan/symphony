<?php

namespace App\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Service\UserService;

class UserServiceTest extends KernelTestCase
{
    public function testUserServiceCreatesUser(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $userService = $container->get(UserService::class);

        $user = $userService->createUser('test@example.com', 'password123');

        $this->assertNotNull($user);
        $this->assertEquals('test@example.com', $user->getEmail());
    }
}
