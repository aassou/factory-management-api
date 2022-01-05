<?php

namespace App\Repository;

use App\Entity\CompanyOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompanyOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyOrder[]    findAll()
 * @method CompanyOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyOrder::class);
    }

    // /**
    //  * @return CompanyOrder[] Returns an array of CompanyOrder objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CompanyOrder
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
