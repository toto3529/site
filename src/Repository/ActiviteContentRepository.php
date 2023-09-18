<?php

namespace App\Repository;

use App\Entity\ActiviteContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ActiviteContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActiviteContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActiviteContent[]    findAll()
 * @method ActiviteContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActiviteContent::class);
    }

    // /**
    //  * @return ActiviteContent[] Returns an array of ActiviteContent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ActiviteContent
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
