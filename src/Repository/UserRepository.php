<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    public function readAll() {
        $query = $this->createQueryBuilder('u')
            ->select(
                'u.id, 
                u.username, 
                u.profil, 
                u.status, 
                u.createdBy, 
                u.created, 
                u.updated, 
                u.updatedBy'
            );

        return $query->getQuery()->getResult();
    }

    /**
     * @param int $id
     * @return User|null
     * @throws NonUniqueResultException
     */
    public function read(int $id): ?User
    {
        return $this->createQueryBuilder('u')
            ->select(
                'u.id, 
                u.username, 
                u.profil, 
                u.status, 
                u.createdBy, 
                u.created, 
                u.updated, 
                u.updatedBy'
            )
            ->andWhere('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
