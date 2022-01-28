<?php

namespace App\Repository;

use App\Entity\InternalOrderLine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InternalOrderLine|null find($id, $lockMode = null, $lockVersion = null)
 * @method InternalOrderLine|null findOneBy(array $criteria, array $orderBy = null)
 * @method InternalOrderLine[]    findAll()
 * @method InternalOrderLine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InternalOrderLineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InternalOrderLine::class);
    }

    // /**
    //  * @return InternalOrderLine[] Returns an array of InternalOrderLine objects
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
    public function findOneBySomeField($value): ?InternalOrderLine
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
