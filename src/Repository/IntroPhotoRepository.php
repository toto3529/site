<?php

namespace App\Repository;

use App\Entity\IntroPhoto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IntroPhoto|null find($id, $lockMode = null, $lockVersion = null)
 * @method IntroPhoto|null findOneBy(array $criteria, array $orderBy = null)
 * @method IntroPhoto[]    findAll()
 * @method IntroPhoto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IntroPhotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IntroPhoto::class);
    }

    // /**
    //  * @return IntroPhoto[] Returns an array of IntroPhoto objects
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
    public function findOneBySomeField($value): ?IntroPhoto
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
