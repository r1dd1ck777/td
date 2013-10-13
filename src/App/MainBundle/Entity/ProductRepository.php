<?php

namespace App\MainBundle\Entity;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;

class ProductRepository extends EntityRepository
{
    public function findByCategoryId($categoryId)
    {
        $qb = $this->getQueryBuilder();
        if ($categoryId == 'all'){
            return $qb;
        }

        $qb->leftJoin("{$this->getAlias()}.category", 'c')
            ->where('c.id = :categoryId')
            ->setParameter('categoryId' , $categoryId)
            ;

        return $qb;
    }

    public function mqSearch($key, QueryBuilder $qb)
    {
        $qb
            ->where("{$this->getPropertyName('name')} LIKE :key")
            ->orWhere("{$this->getPropertyName('info')} LIKE :key")
            ->orWhere("{$this->getPropertyName('description')} LIKE :key")
            ->orWhere("{$this->getPropertyName('price')} LIKE :key")
            ->orWhere("{$this->getPropertyName('code')} LIKE :key")
            ->setParameter('key', "%{$key}%")
            ;
    }
}