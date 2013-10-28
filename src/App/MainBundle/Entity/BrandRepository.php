<?php

namespace App\MainBundle\Entity;

class BrandRepository extends EntityRepository
{
    public function findByCategoryId($id)
    {
        $qb = $this->createQueryBuilder($this->getAlias())
            ->leftJoin($this->getPropertyName('categories'), 'c')
            ->where('c.id = :id')
            ->setParameter('id', $id)
        ;

        return $qb;
    }
}
