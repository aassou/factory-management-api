<?php

namespace App\Manager;

use App\Exception\PropertyNotFoundException;
use App\Repository\ApartmentRepository;
use App\Trait\HistoryTrait;
use App\Utils\HistoryUtils;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Apartment;

/**
 * Class ApartmentManager
 * @package App\Manager
 */
class ApartmentManager extends AbstractManager
{
    use HistoryTrait;

    /**
     * @param EntityManagerInterface $entityManager
     * @param HistoryManager $historyManager
     */
    public function __construct(EntityManagerInterface $entityManager, HistoryManager $historyManager)
    {
        $this->entityManager = $entityManager;
        $this->historyManager = $historyManager;
    }

    /**
     * @param array $data
     * @param string $currentUserName
     * @return Apartment
     */
    public function create(array $data, string $currentUserName): Apartment
    {
        $apartmentData = array_merge(
            $data,
            ["created" => new DateTime(), "createdBy" => $currentUserName]
        );

        $apartment = new Apartment($apartmentData);

        $this->entityManager->persist($apartment);
        $this->entityManager->flush();

        $historyData = HistoryUtils::buildHistoryData(
            HistoryManager::ADD,
            Apartment::class,
            ["status" => HistoryManager::SUCCESS, "label" => $apartment->getName()]
        );

        $this->historyManager->create($historyData, $currentUserName);

        return $apartment;
    }

    /**
     * @param int $id
     * @return Apartment
     * @throws PropertyNotFoundException
     */
    public function read(int $id): Apartment
    {
        /** @var ApartmentRepository $repository */
        $repository = $this->entityManager->getRepository(Apartment::class);

        /** @var Apartment $apartment */
        $apartment = $repository->findOneBy(['id' => $id]);

        if (!$apartment) {
            throw new PropertyNotFoundException('Property Not Found!');
        }

        return $apartment;
    }

    /**
     * @param array $data
     * @param string $currentUserName
     * @param int $id
     * @return Apartment
     * @throws PropertyNotFoundException
     */
    public function update(array $data, string $currentUserName, int $id): Apartment
    {
        /** @var ApartmentRepository $repository */
        $repository = $this->entityManager->getRepository(Apartment::class);

        /** @var Apartment $apartment */
        $apartment = $repository->findOneBy(['id' => $id]);

        if (!$apartment) {
            throw new PropertyNotFoundException('Property Not Found!');
        }

        $apartmentData = array_merge(
            $data,
            ["updated" => new DateTime(), "updatedBy" => $currentUserName]
        );

        $apartment->hydrate($apartmentData);

        $this->entityManager->persist($apartment);
        $this->entityManager->flush();

        $historyData = $this->buildHistoryData(
            HistoryManager::UPDATE,
            Apartment::class,
            ["status" => HistoryManager::SUCCESS, "label" => $apartment->getName()]
        );

        $this->historyManager->create($historyData, $currentUserName);

        return $apartment;
    }

    /**
     * @param string $currentUserName
     * @param int $id
     * @throws PropertyNotFoundException
     */
    public function delete(string $currentUserName, int $id): void
    {
        /** @var ApartmentRepository $repository */
        $repository = $this->entityManager->getRepository(Apartment::class);
        /** @var Apartment $apartment */
        $apartment = $repository->findOneBy(['id' => $id]);

        if (!$apartment) {
            throw new PropertyNotFoundException('Property Not Found!');
        }

        $this->entityManager->remove($apartment);
        $this->entityManager->flush();
    }

    /**
     * @return array
     */
    public function readAll(): array
    {
        return $this->entityManager->getRepository(Apartment::class)->findAll();
    }

    /**
     * @param $projectId
     * @return array
     */
    public function readAllByProjectId($projectId): array
    {
        /** @var ApartmentRepository $repository */
        $repository = $this->entityManager->getRepository(Apartment::class);

        return $repository->findBy(["projectId" => $projectId]);
    }
}
