<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Documentation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Documentation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Documentation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Documentation[]    findAll()
 * @method Documentation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Documentation::class);
    }

    public function findDocumentationOrderByDateModifier(){
        $documentation = $this
            ->createQueryBuilder('d')
            ->orderBy('d.date_modifier', 'ASC');
        $query = $documentation->getQuery();
        return $query->getResult();
    }

    public function findSearchDocumentation(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('doc')
            ->addSelect('doc.auteur')
            ->addSelect('doc.titre')
            ->addSelect('doc.intro')
            ->innerJoin('doc.categorie', 'c')
            ->addSelect('doc.id')
            ->addSelect('doc.date_creation')
            ->orderBy('doc.date_modifier', 'DESC');

        if (!empty($search->q)) {
            $query = $query
                ->andWhere('doc.titre LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }

        if (!empty($search->categories)){
            $query = $query
                ->andWhere('c.id IN (:categories)')
                ->setParameter('categories', $search->categories);
        }


        return $query->getQuery()->getResult();

    }

}
