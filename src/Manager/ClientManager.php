<?php

namespace App\Manager;

use App\Exception\ClientNotFoundException;
use App\Repository\ClientRepository;
use App\Trait\HistoryTrait;
use App\Utils\HistoryUtils;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Client;

/**
 * Class ClientManager
 * @package App\Manager
 */
class ClientManager extends AbstractManager
{
    use HistoryTrait;

    /**
     * @param EntityManagerInterface $entityManager
     * @param HistoryManager $historyManager
     */
    public function __construct(EntityManagerInterface $entityManager,HistoryManager $historyManager) {
        $this->entityManager = $entityManager;
        $this->historyManager = $historyManager;
    }

    /**
     * @param array $data
     * @param string $currentUserName
     * @return Client
     */
    public function create(array $data, string $currentUserName): Client {
        $clientData = array_merge(
            $data,
            ["created" => new DateTime(), "createdBy" => $currentUserName]
        );

        $client = new Client($clientData);

        $this->entityManager->persist($client);
        $this->entityManager->flush();

        $historyData = HistoryUtils::buildHistoryData(
            HistoryManager::ADD,
            Client::class,
            ["status" => HistoryManager::SUCCESS, "label" => $client->getNom()]);

        $this->historyManager->create($historyData, $currentUserName);

        return $client;
    }
   
    /**
     * @return array
     */
    public function readAll(): array {
        /** @var ClientRepository $repository */
        $repository = $this->entityManager->getRepository(Client::class);

        return $repository->findAll();
    }

    /**
     * @param array $data
     * @param string $currentUserName
     * @param int $id
     * @return Client
     * @throws ClientNotFoundException
     */
    public function update(array $data, string $currentUserName, int $id): Client {
        /** @var ClientRepository $repository */
        $repository = $this->entityManager->getRepository(Client::class);
        /** @var Client $client */
        $client = $repository->findOneBy(['id' => $id]);
        
        if (!$client) {
            throw new ClientNotFoundException(sprintf("Client with id %s not found", $id));
        }

        $clientData = array_merge(
            $data,
            ["updated" => new DateTime(), "updatedBy" => $currentUserName]
        );

        $client->hydrate($clientData);

        $this->entityManager->persist($client);
        $this->entityManager->flush();
        $historyData = [
            'action' =>"Modification",
            'target' => "Table des Clients",
            'description' => "Modification de le client : ".$client->getNom(),
        ];
        $this->historyManager->create($historyData,$currentUserName);

        return $client;
    }

    /**
     * @param int $id
     * @return Client
     * @throws ClientNotFoundException
     */
    public function read(int $id): Client
    {
        /** @var ClientRepository $repository */
        $repository = $this->entityManager->getRepository(Client::class);
        /** @var Client $client */
        $client = $repository->findOneBy(['id' => $id]);

        if (!$client) {
            throw new ClientNotFoundException(sprintf("Client with id %s not found", $id));
        }

        return $client;
    }

    public function delete(string $currentUserName, int $id): void
    {
        // TODO: Implement delete() method.
    }
}