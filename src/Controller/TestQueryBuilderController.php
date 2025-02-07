<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class TestQueryBuilderController extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('/test-querybuilder', name: 'test_querybuilder', methods: ['GET'])]
    public function test(): Response
    {
        $users = $this->userRepository->findUsersWithGroups();
        return $this->json($users);
    }
}
