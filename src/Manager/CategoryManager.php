<?php

namespace App\Manager;

use App\Entity\Category;
use App\Exception\CategoryNotFoundException;
use App\Repository\CategoryRepository;
use App\Trait\HistoryTrait;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Logger;

/**
 * @class CategoryManager
 * @author Abdelilah Aassou <aassou.abdelilah@gmail.com>
 */
class CategoryManager extends AbstractManager
{
    use HistoryTrait;

    /**
     * @var Logger
     */
    private Logger $logger;

    /**
     * @param EntityManagerInterface $entityManager
     * @param HistoryManager $historyManager
     * @param Logger $logger
     */
    public function __construct(EntityManagerInterface $entityManager, HistoryManager $historyManager, Logger $logger)
    {
        $this->entityManager = $entityManager;
        $this->historyManager = $historyManager;
        $this->logger = $logger;
    }

    /**
     * @param array $data
     * @param string $currentUserName
     * @return Category
     */
    public function create(array $data, string $currentUserName): Category
    {
        $categoryData = [
            $data,
            ['created' => new DateTime(), 'createdBy' => $currentUserName]
        ];

        $category = new Category($categoryData);

        $this->entityManager->persist($category);
        $this->entityManager->flush();

        $historyData = [
            HistoryManager::ADD,
            Category::class,
            ['status' => HistoryManager::SUCCESS, 'label' => $category->getName()]
        ];

        $this->historyManager->create($historyData, $currentUserName);

        return $category;
    }

    /**
     * @param int $id
     * @return Category
     * @throws CategoryNotFoundException
     */
    public function read(int $id): Category
    {
        /** @var CategoryRepository $repository */
        $repository = $this->entityManager->getRepository(Category::class);

        /** @var Category $category */
        $category = $repository->findOneBy(['id' => $id]);

        if (!$category) {
            $this->logger->error(sprintf('Salam id: %s not found!', $id));
            throw new CategoryNotFoundException(sprintf('Category with id: %s not found!', $id));
        }

        return $category;
    }

    /**
     * @param array $data
     * @param string $currentUserName
     * @param int $id
     * @return mixed
     * @throws CategoryNotFoundException
     */
    public function update(array $data, string $currentUserName, int $id): mixed
    {
        /** @var CategoryRepository $repository */
        $repository = $this->entityManager->getRepository(Category::class);

        /** @var Category $category */
        $category = $repository->findOneBy(['id' => $id]);

        if (!$category) {
            throw new CategoryNotFoundException(sprintf('Category with id: %s not found!', $id));
        }

        $categoryData = [
            $data,
            ['updated' => new DateTime(), 'updatedBy' => $currentUserName]
        ];

        $category->hydrate($categoryData);

        $this->entityManager->persist($category);
        $this->entityManager->flush();

        $historyData = [
            HistoryManager::UPDATE,
            Category::class,
            ['status' => HistoryManager::SUCCESS, 'label' => $category->getName()]
        ];

        $this->historyManager->create($historyData, $currentUserName);

        return $category;
    }

    /**
     * @param string $currentUserName
     * @param int $id
     * @throws CategoryNotFoundException
     */
    public function delete(string $currentUserName, int $id): void
    {
        /** @var CategoryRepository $repository */
        $repository = $this->entityManager->getRepository(Category::class);

        /** @var Category $category */
        $category = $repository->findOneBy(['id' => $id]);

        if (!$category) {
            throw new CategoryNotFoundException(sprintf('Category with id: %s not found', $id));
        }

        $this->entityManager->remove($category);
        $this->entityManager->flush();
    }

    /**
     * @return array
     */
    public function readAll(): array
    {
        return $this->entityManager->getRepository(Category::class)->findAll();
    }
}