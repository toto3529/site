<?php

namespace App\Repository;

use App\Entity\TextAccueil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TextAccueil|null find($id, $lockMode = null, $lockVersion = null)
 * @method TextAccueil|null findOneBy(array $criteria, array $orderBy = null)
 * @method TextAccueil[]    findAll()
 * @method TextAccueil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TextAccueilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TextAccueil::class);
    }

    // /**
    //  * @return TextAccueil[] Returns an array of TextAccueil objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TextAccueil
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
