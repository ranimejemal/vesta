<?php

namespace App\Repository;

use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    public function findByCriteria(array $criteria)
    {
        $queryBuilder = $this->createQueryBuilder('p');

        if (isset($criteria['price'])) {
            if (isset($criteria['price']['min'])) {
                $queryBuilder->andWhere('p.price >= :minPrice')
                    ->setParameter('minPrice', $criteria['price']['min']);
            }
            if (isset($criteria['price']['max'])) {
                $queryBuilder->andWhere('p.price <= :maxPrice')
                    ->setParameter('maxPrice', $criteria['price']['max']);
            }
        }

        if (isset($criteria['type'])) {
            $queryBuilder->andWhere('p.type = :type')
                ->setParameter('type', $criteria['type']);
        }

        if (isset($criteria['area'])) {
            if (isset($criteria['area']['min'])) {
                $queryBuilder->andWhere('p.area >= :minArea')
                    ->setParameter('minArea', $criteria['area']['min']);
            }
        }

        return $queryBuilder->getQuery()->getResult();
    }
}
