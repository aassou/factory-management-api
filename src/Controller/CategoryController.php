<?php

namespace App\Controller;

use App\Exception\CategoryNotFoundException;
use App\Manager\CategoryManager;
use App\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

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