<?php

namespace App\Repository;

use App\Entity\TextPresentation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TextPresentation|null find($id, $lockMode = null, $lockVersion = null)
 * @method TextPresentation|null findOneBy(array $criteria, array $orderBy = null)
 * @method TextPresentation[]    findAll()
 * @method TextPresentation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TextPresentationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TextPresentation::class);
    }

    // /**
    //  * @return TextPresentation[] Returns an array of TextPresentation objects
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
    public function findOneBySomeField($value): ?TextPresentation
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
