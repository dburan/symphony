<?php

namespace App\Controller;

use App\Formatter\ApiResponseFormatter;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class UserController extends AbstractController
{
    public function __construct(
        private UserRepository $UserRepository,
        private ApiResponseFormatter $apiResponseFormatter
    ) {
    }

    #[Route('/users2', name: 'app_user2', methods: ['GET'])]
    public function index(Request $request): Response
    {
        // Получаем параметры запроса для фильтрации или сортировки
        $filter = $request->query->get('filter', null);
        $sortBy = $request->query->get('sort_by', 'id');
        $sortOrder = $request->query->get('sort_order', 'ASC');

        $queryBuilder = $this->UserRepository->createQueryBuilder('u');

        if ($filter) {
            $queryBuilder->andWhere('u.name LIKE :filter')
                ->setParameter('filter', '%' . $filter . '%');
        }

        $queryBuilder->orderBy('u.' . $sortBy, $sortOrder);

        $users = $queryBuilder->getQuery()->getResult();

        $transformedUsers = [];
        foreach ($users as $user) {
            $transformedUsers[] = $user->toArray();
        }

        return $this->apiResponseFormatter
            ->withData($transformedUsers)
            ->response();
    }

    #[Route('/users2/groups', name: 'app_users_with_groups', methods: ['GET'])]
    public function usersWithGroups(): Response
    {
        $users = $this->UserRepository->findUsersWithGroups();

        $transformedUsers = [];
        foreach ($users as $user) {
            $transformedUsers[] = $user->toArray();
        }

        return $this->apiResponseFormatter
            ->withData($transformedUsers)
            ->response();
    }

    #[Route('/users2/{id}', name: 'app_user_show2', methods: ['GET'])]
    public function show(int $id): Response
    {
        $user = $this->UserRepository->findOneBy(['id' => $id]);

        return $this->apiResponseFormatter
            ->withData($user->toArray())
            ->response();
    }

    #[Route('/users2', name: 'create_user2', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        // Получаем данные из запроса
        $data = json_decode($request->getContent(), true);

        // Создаем нового пользователя (предполагается, что у User есть метод setName)
        $user = new User();
        $user->setName($data['name'] ?? 'Default Name');

        // Сохраняем пользователя
        $this->UserRepository->save($user);

        return $this->apiResponseFormatter
            ->withMessage('User created successfully.')
            ->withData($user->toArray())
            ->response();
    }

    #[Route('/users2/{id}', name: 'update_user2', methods: ['PATCH'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $user = $this->UserRepository->findOneBy(['id' => $id]);
        if (!$user) {
            return $this->apiResponseFormatter
                ->withError('User not found.')
                ->response();
        }

        $data = json_decode($request->getContent(), true);
        if (isset($data['name'])) {
            $user->setName($data['name']);
        }

        $this->UserRepository->save($user);

        return $this->apiResponseFormatter
            ->withMessage('User updated successfully.')
            ->withData($user->toArray())
            ->response();
    }

    #[Route('/users2/{id}', name: 'delete_user2', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $user = $this->UserRepository->findOneBy(['id' => $id]);
        if (!$user) {
            return $this->apiResponseFormatter
                ->withError('User not found.')
                ->response();
        }

        $this->UserRepository->remove($user);

        return $this->apiResponseFormatter
            ->withMessage('User deleted successfully.')
            ->response();
    }
}
