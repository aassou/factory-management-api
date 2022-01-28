<?php

namespace App\Repository;

use App\Entity\ExternalOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExternalOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExternalOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExternalOrder[]    findAll()
 * @method ExternalOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExternalOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExternalOrder::class);
    }

    // /**
    //  * @return ExternalOrder[] Returns an array of ExternalOrder objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExternalOrder
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
