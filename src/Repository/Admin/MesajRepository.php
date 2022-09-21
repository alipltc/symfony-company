<?php

namespace App\Repository\Admin;

use App\Entity\Admin\Mesaj;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Mesaj|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mesaj|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mesaj[]    findAll()
 * @method Mesaj[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MesajRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mesaj::class);
    }

    // /**
    //  * @return Mesaj[] Returns an array of Mesaj objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mesaj
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
