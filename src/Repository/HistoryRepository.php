<?php

namespace App\Repository;

use App\Entity\History;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method History|null find($id, $lockMode = null, $lockVersion = null)
 * @method History|null findOneBy(array $criteria, array $orderBy = null)
 * @method History[]    findAll()
 * @method History[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, History::class);
    }

    // /**
    //  * @return History[] Returns an array of History objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?History
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return int|mixed|string
     */
    public function getHistoryMonths(){
        $query = $this->createQueryBuilder('h')
            ->select('MONTH(h.created) as month, YEAR(h.created) as year')
            ->groupBy('month,year')
            ->orderBy('year','DESC')
            ->addOrderBy('month','DESC');

        return $query->getQuery()->getResult();
    }

    /**
     * @param $month
     * @param $year
     * @return int|mixed|string
     */
    public function getHistoryByExactMonth($month,$year){
        $query = $this->createQueryBuilder('h')
            //->select("h.id,h.action,h.target,h.description,h.created,h.createdBy")
            ->where("MONTH(h.created) = $month")
            ->andWhere("YEAR(h.created) = $year")
            ->orderBy('h.created', 'DESC');

        return $query->getQuery()->getResult();
    }
}
