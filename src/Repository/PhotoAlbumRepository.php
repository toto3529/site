<?php

namespace App\Repository;

use App\Entity\PhotoAlbum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PhotoAlbum|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotoAlbum|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotoAlbum[]    findAll()
 * @method PhotoAlbum[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoAlbumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhotoAlbum::class);
    }


}
