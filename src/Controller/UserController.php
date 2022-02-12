<?php

namespace App\Controller;

use App\Exception\UserExistsException;
use App\Exception\UserNotFoundException;
use App\Manager\UserManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * UserController
 * @author Abdelilah Aassou <email: aassou.abdelilah@gmail.com>
 * @package App\Controller
 */
class UserController extends AbstractController
{
    /**
     * @var UserManager
     */
    private UserManager $userManager;

    /**
     * UserController constructor.
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager) {
        $this->userManager = $userManager;
    }

    /**
     * Welcome message for connected user.
     *
     * This call show a message for a connected user.
     * @return JsonResponse
     */
    #[Route('/api/user', name: 'user_index', methods: ['GET'])]
    #[Cache(smaxage: 10)]
    public function index(): JsonResponse
    {
        return $this->json(['users' => "Welcome!"]);
    }

    /**
     * Create a new user.
     *
     * This call creates a new user.
     * @param Request $request
     * @param UserPasswordHasherInterface $encoder
     * @return JsonResponse
     * @throws UserExistsException
     */
    #[Route('/api/user/create', name:'create_user', methods: ['POST'])]
    public function create(Request $request, UserPasswordHasherInterface $encoder): JsonResponse {
        $data = json_decode($request->getContent(), true);
        $user = $this->userManager->register($data, $encoder, $this->getUser()->getUsername());

        return $this->json([
            'message' => sprintf(
                'Utilisateur %s créée avec succès!',
                ucfirst($user->getUsername())
            )
        ]);
    }

    /**
     * @return JsonResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[Route("/api/user/current", name: 'current_user', methods: ['GET'])]
    public function getCurrentUser(): JsonResponse
    {
        if (!$this->container->has('security.token_storage')) {
            throw new \LogicException('The Security Bundle is not registered in your application.');
        }

        $token = $this->container->get('security.token_storage')->getToken();
        if (null === $token) {
            return $this->json([]);
        }

        $user = $token->getUser();

        if (!is_object($user)) {
            return $this->json([]);
        }

        return $this->json(['user' => $user]);
    }
//    public function getCurrentUser(): JsonResponse
//    {
//        return $this->json(["current_user" => $this->getUser()->getUserIdentifier()]);
//    }

    /**
     * Get one user.
     *
     * This call get one user by id.
     * @param int $id
     * @return JsonResponse
     * @throws UserNotFoundException
     * @throws NonUniqueResultException
     */
    #[Route('/api/user/{id}', name: 'user_read_one_by_id', methods: ['GET'])]
    public function read(int $id): JsonResponse
    {
        $user = $this->userManager->read($id);

        if (!$user) {
            throw new NotFoundHttpException(sprintf("User %s not found", $id));
        }

        return $this->json($user);
    }

    /**
     * Update an existing user.
     *
     * This call creates a new user.
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws UserNotFoundException
     */
    #[Route('/api/user/{id}', name: 'update_user', methods: ['PATCH'])]
    public function update(Request $request, int $id): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = $this->userManager->update($data, $this->getUser()->getUsername(), $id);

        if (!$user) {
            throw new NotFoundHttpException(sprintf("User with id %s not found", $id));
        }

        return $this->json([
            'message' => sprintf('Updated the user with login %s', $user->getUsername())
        ]);
    }

    /**
     * Get all users.
     *
     * @return JsonResponse
     */
    #[Route('/api/user', name: 'get_all_users', methods: ['GET'])]
    public function readAll(): JsonResponse
    {
        return $this->json(['users' => $this->userManager->readAll()]);
    }

    /**
     * check token validity.
     *
     * This call checks the validity of token.
     * @return JsonResponse
     */
    #[Route('/api/checktoken')]
    public function checkToken(): JsonResponse
    {
        return $this->json(['message' => 'token is valid']);
    }
}
