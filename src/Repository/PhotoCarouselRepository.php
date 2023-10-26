<?php

namespace App\Repository;

use App\Entity\PhotoCarousel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PhotoCarousel|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotoCarousel|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotoCarousel[]    findAll()
 * @method PhotoCarousel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoCarouselRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhotoCarousel::class);
    }


}
