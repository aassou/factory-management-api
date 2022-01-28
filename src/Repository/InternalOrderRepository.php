<?php

namespace App\Repository;

use App\Entity\InternalOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InternalOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method InternalOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method InternalOrder[]    findAll()
 * @method InternalOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InternalOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InternalOrder::class);
    }

    // /**
    //  * @return InternalOrder[] Returns an array of InternalOrder objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InternalOrder
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
