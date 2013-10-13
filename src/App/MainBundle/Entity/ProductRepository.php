<?php

namespace App\MainBundle\Entity;

use Doctrine\ORM\NonUniqueResultException;

class ProductRepository extends EntityRepository
{
    public function findByCategoryId($categoryId)
    {
        $qb = $this->getQueryBuilder()
            ->leftJoin("{$this->getAlias()}.category", 'c')
            ->where('c.id = :categoryId')
            ->setParameter('categoryId' , $categoryId)
            ;

        return $qb;
    }
}
