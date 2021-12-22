<?php

namespace App\Controller;

use App\Exception\CategoryNotFoundException;
use App\Manager\CategoryManager;
use App\Entity\Category;
use Psr\Log\LoggerAwareInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;

/**
 * CategoryController
 * @author Abdelilah Aassou <email: aassou.abdelilah@gmail.com>
 * @package App\Controller
 */
class CategoryController extends AbstractController implements CrudControllerInterface
{

    /**
     * @var CategoryManager
     */
    private CategoryManager $categoryManager;

    /**
     * @var Logger
     */
    private Logger $logger;

    /**
     * @param CategoryManager $categoryManager
     * @param Logger $logger
     */
    public function __construct(CategoryManager $categoryManager, Logger $logger)
    {
        $this->categoryManager = $categoryManager;
        $this->logger = $logger;
    }

    /**
     * Get all categories.
     *
     * This call get all the categories for a connected user.
     * @OA\Response(
     *     response=200,
     *     description="Returns all categories",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Category::class, groups={"full"}))
     *     )
     * )
     * @OA\Tag(name="category")
     * @Security(name="Bearer")
     * @return JsonResponse
     */
    #[Route('/api/category', name: 'category_index', methods: ['GET'])]
    #[Cache(smaxage: 10)]
    public function index(): JsonResponse
    {
        $categories = $this->categoryManager->readAll();

        return $this->json($categories);
    }

    /**
     * Create a new category.
     *
     * This call creates a new category.
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Category attributes",
     *    @OA\JsonContent(
     *       required={"name"},
     *       @OA\Property(property="name", type="string", format="string", example="metal"),
     *       @OA\Property(property="image", type="string", format="string", example="https://loremflickr.com/320/240/product"),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Creates new category",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Category::class, groups={"full"}))
     *     )
     * )
     * @OA\Tag(name="category")
     * @Security(name="Bearer")
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/api/category/create', name: 'category_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $category = $this->categoryManager->create($data, $this->getUser()->getUsername()());

        return $this->json($category);
    }

    /**
     * Get one category.
     *
     * This call get one category by id.
     * @OA\Response(
     *     response=200,
     *     description="Returns a category by id",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Category::class, groups={"full"}))
     *     )
     * )
     * @OA\Tag(name="category")
     * @Security(name="Bearer")
     * @param int $id
     * @return JsonResponse
     * @throws CategoryNotFoundException
     */
    #[Route('/api/category/{id}', name: 'category_get_one_by_id', methods: ['GET'])]
    public function read(int $id): JsonResponse
    {
        $category = $this->categoryManager->read($id);

        if (!$category) {
            $this->logger->error(sprintf('Salam 3alikom %s', $id));
            throw new NotFoundHttpException(sprintf('Category with id: %s not found!', $id));
        }

        return $this->json($category);
    }

    /**
     * Update an existing category.
     *
     * This call updates an existing category.
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Category attributes",
     *    @OA\JsonContent(
     *       required={"name"},
     *       @OA\Property(property="name", type="string", format="string", example="metal"),
     *       @OA\Property(property="image", type="string", format="string", example="https://loremflickr.com/320/240/product"),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Updates an exisiting category",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Category::class, groups={"full"}))
     *     )
     * )
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="The field used to select category",
     *     @OA\Schema(type="int")
     * )
     * @OA\Tag(name="category")
     * @Security(name="Bearer")
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws CategoryNotFoundException
     */
    #[Route('/api/category/{id}', name: 'category_update', methods: ['PATCH'])]
    public function update(Request $request, int $id): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $category = $this->categoryManager->update($data, $this->getUser()->getUsername()(), $id);
        dd($this->get('kernel'));
        if (!$category) {
            $this->logger->error(sprintf('Salam 3alikom %s', $id));
            throw new NotFoundHttpException(sprintf('Category with id: %s not found!', $id));
        }

        return $this->json($category);
    }

    /**
     * Delete a category.
     *
     * This call deletes a category.
     *
     * @OA\Response(
     *     response=200,
     *     description="Deletes a category",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Category::class, groups={"full"}))
     *     )
     * )
     * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="The field used to select category",
     *     @OA\Schema(type="int")
     * )
     * @OA\Tag(name="category")
     * @Security(name="Bearer")
     * @param int $id
     * @return JsonResponse
     * @throws CategoryNotFoundException
     */
    #[Route('/api/category/{id}', name: 'category_delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $this->categoryManager->delete($this->getUser()->getUsername(), $id);

        return $this->json(["message" => sprintf('Category with id:%s deleted successfully!', $id)]);
    }
}