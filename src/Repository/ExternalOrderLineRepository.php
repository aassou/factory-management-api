<?php

namespace App\Repository;

use App\Entity\ExternalOrderLine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExternalOrderLine|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExternalOrderLine|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExternalOrderLine[]    findAll()
 * @method ExternalOrderLine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExternalOrderLineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExternalOrderLine::class);
    }

    // /**
    //  * @return ExternalOrderLineFixtures[] Returns an array of ExternalOrderLineFixtures objects
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
    public function findOneBySomeField($value): ?ExternalOrderLineFixtures
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
