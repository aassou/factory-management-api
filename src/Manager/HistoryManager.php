<?php

namespace App\Manager;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\History;

/**
 * Class HistoryManager
 * @package App\Manager
 */
class HistoryManager extends AbstractManager
{
    const ADD = 'Add';
    const DELETE = 'Delete';
    const UPDATE = 'Update';
    const ACTIONS = [self::ADD, self::UPDATE, self::DELETE];

    const SUCCESS = 'Successfully';
    const ERROR = 'Error';
    const STATUS = [self::SUCCESS, self::ERROR];

    /**
     * HistoryManager constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param array $data
     * @param string $currentUserName
     * @return History
     */
    public function create(array $data, string $currentUserName): History {
        $history = new History();
        $history->setAction(self::ADD);
        $history->setTarget($data["target"]);
        $history->setDescription($data["description"]);
        $history->setCreatedBy($currentUserName);
        $history->setCreated(new DateTime());

        $this->entityManager->persist($history);
        $this->entityManager->flush();

        return $history;
    }

    /**
     * @param int $id
     * @return History
     */
    public function read(int $id): History
    {
        // TODO: Implement read() method.
    }

    /**
     * @param array $data
     * @param string $currentUserName
     * @param int $id
     * @return History
     */
    public function update(array $data, string $currentUserName, int $id): History
    {
        // TODO: Implement update() method.
    }

    /**
     * @param string $currentUserName
     * @param int $id
     */
    public function delete(string $currentUserName, int $id): void
    {
        // TODO: Implement delete() method.
    }

    /**
     * @return array
     */
    public function readAll(): array {
        $repository = $this->entityManager->getRepository(History::class);

        return $repository->findAll();
    }


    /**
     * @return array
     */
    public function getHistoryMonths(): array {
        $repository = $this->entityManager->getRepository(History::class);

        return $repository->getHistoryMonths();
    }

    /**
     * @param string $month
     * @param string $year
     * @return array
     */
    public function getHistoryByExactMonth(string $month, string $year): array {
        $repository = $this->entityManager->getRepository(History::class);

        return $repository->getHistoryByExactMonth($month,$year);
    }
}