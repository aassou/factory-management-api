<?php

namespace App\Manager;

use App\Exception\UserExistsException;
use App\Exception\UserNotFoundException;
use App\Repository\UserRepository;
use App\Trait\HistoryTrait;
use App\Utils\HistoryUtils;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class UserManager
 * @package App\Manager
 */
class UserManager extends AbstractManager
{

    use HistoryTrait;

    /**
     * @param EntityManagerInterface $entityManager
     * @param HistoryManager $historyManager
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        HistoryManager $historyManager
    ) {
        $this->entityManager = $entityManager;
        $this->historyManager = $historyManager;
    }

    /**
     * @param array $data
     * @param UserPasswordHasherInterface $encoder
     * @param string $currentUserName
     * @return bool|User
     * @throws UserExistsException
     */
    public function register(array $data, UserPasswordHasherInterface $encoder, string $currentUserName): bool|User
    {
        /** @var UserRepository $repository */
        $repository = $this->entityManager->getRepository(User::class);
        $user = $repository->findOneBy(['username' => $data['username']]);

        if ($user) {
            throw new UserExistsException(sprintf("Username %s already exists", $user->getUsername()));
        }

        $user = new User();
        $user->setUsername($data['username']);
        $user->setPassword($encoder->hashPassword($user, $data['password']));
        $user->setProfil($data['profil']);
        $user->setStatus($data['status']);
        $user->setCreated(new DateTime());
        $user->setCreatedBy($currentUserName);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $historyData = HistoryUtils::buildHistoryData(
            HistoryManager::ADD,
            User::class,
            ["status" => HistoryManager::SUCCESS, "label" => $user->getUserName()]);

        $this->historyManager->create($historyData, $currentUserName);

        return $user;
    }

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     * @throws NonUniqueResultException
     */
    public function read(int $id): User
    {
        /** @var UserRepository $repository */
        $repository = $this->entityManager->getRepository(User::class);
        $user = $repository->read($id);

        if (!$user) {
            throw new UserNotFoundException(sprintf("User with id %s not found", $id));
        }

        return $user;
    }

    /**
     * @param array $data
     * @param string $currentUserName
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function update(array $data, string $currentUserName, int $id): User {
        /** @var UserRepository $repository */
        $repository = $this->entityManager->getRepository(User::class);
        $user = $repository->findOneBy(['id' => $id]);

        if (!$user) {
            throw new UserNotFoundException(sprintf("User with id %s not found", $id));
        }

        $userData = array_merge(
            $data,
            ["updated" => new DateTime(), "updatedBy" => $currentUserName]
        );

        $user->hydrate($userData);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $historyData = HistoryUtils::buildHistoryData(
            HistoryManager::UPDATE,
            User::class,
            ["status" => HistoryManager::SUCCESS, "label" => $user->getUserName()]);

        $this->historyManager->create($historyData, $currentUserName);

        return $user;
    }
    /**
     * @return array
     */
    public function readAll(): array {
        /** @var UserRepository $repository */
        $repository = $this->entityManager->getRepository(User::class);

        return $repository->readAll();
    }

    /**
     * @param string $currentUserName
     * @param int $id
     */
    public function delete(string $currentUserName, int $id):void {
        /** @var UserRepository $repository */
        $repository = $this->entityManager->getRepository(User::class);
        $user = $repository->findOneBy(['id' => $id]);

        $this->entityManager->remove($user);
        $this->entityManager->flush();

        $historyData = HistoryUtils::buildHistoryData(
            HistoryManager::DELETE,
            User::class,
            ["status" => HistoryManager::SUCCESS, "label" => $user->getUserName()]);

        $this->historyManager->create($historyData, $currentUserName);
    }

    public function create(array $data, string $currentUserName): mixed
    {
        // TODO: Implement create() method.
    }
}