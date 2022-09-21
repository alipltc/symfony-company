<?php

namespace App\Repository\Admin;

use App\Entity\Admin\Konu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Konu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Konu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Konu[]    findAll()
 * @method Konu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KonuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Konu::class);
    }

    // /**
    //  * @return Konu[] Returns an array of Konu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Konu
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
