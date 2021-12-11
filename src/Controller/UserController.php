<?php

namespace App\Controller;

use App\Exception\UserExistsException;
use App\Exception\UserNotFoundException;
use App\Manager\UserManager;
use Doctrine\ORM\NonUniqueResultException;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Entity\User;

/**
 * Class UserController
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
     * @OA\Response(
     *     response=200,
     *     description="Returns a simple message",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=User::class, groups={"full"}))
     *     )
     * )
     * @OA\Tag(name="user")
     * @Security(name="Bearer")
     */
    #[Route('/api/user', name: 'user_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return $this->json(['users' => $this->userManager->readAll()]);
    }

    /**
     * Create a new user.
     *
     * This call creates a new user.
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="User attributes",
     *    @OA\JsonContent(
     *       required={"username","password", "profil", "status"},
     *       @OA\Property(property="username", type="string", format="string", example="amin"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *       @OA\Property(property="profil", type="string", example="admin"),
     *       @OA\Property(property="status", type="int", example="1")
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Creates a user",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=User::class, groups={"full"}))
     *     )
     * )
     * @OA\Tag(name="user")
     * @Security(name="Bearer")
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
            'message' => sprintf('Saved new user with login %s', $user->getUsername())
        ]);
    }

    /**
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
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="User attributes",
     *    @OA\JsonContent(
     *       required={"username", "profil", "status"},
     *       @OA\Property(property="username", type="string", format="string", example="amin"),
     *       @OA\Property(property="profil", type="string", example="admin"),
     *       @OA\Property(property="status", type="int", example="1")
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Updates an exisiting user",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=User::class, groups={"full"}))
     *     )
     * )
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="The field used to select user",
     *     @OA\Schema(type="int")
     * )
     * @OA\Tag(name="user")
     * @Security(name="Bearer")
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
     * @return JsonResponse
     */
    #[Route('/api/user', name: 'get_all_users', methods: ['GET'])]
    public function readAll(): JsonResponse
    {
        return $this->json(['users' => $this->userManager->readAll()]);
    }

    /**
     * @return JsonResponse
     */
    #[Route('/api/checktoken')]
    public function checkToken(): JsonResponse
    {
        return $this->json(['message' => 'token is valid']);
    }

}
