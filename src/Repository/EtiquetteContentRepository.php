<?php

namespace App\Repository;

use App\Entity\EtiquetteContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EtiquetteContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtiquetteContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtiquetteContent[]    findAll()
 * @method EtiquetteContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtiquetteContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtiquetteContent::class);
    }

    // /**
    //  * @return EtiquetteContent[] Returns an array of EtiquetteContent objects
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
    public function findOneBySomeField($value): ?EtiquetteContent
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
