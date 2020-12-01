<?php

namespace App\Repository;

use App\Entity\LivrablesRendus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LivrablesRendus|null find($id, $lockMode = null, $lockVersion = null)
 * @method LivrablesRendus|null findOneBy(array $criteria, array $orderBy = null)
 * @method LivrablesRendus[]    findAll()
 * @method LivrablesRendus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivrablesRendusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LivrablesRendus::class);
    }

    // /**
    //  * @return LivrablesRendus[] Returns an array of LivrablesRendus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LivrablesRendus
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
