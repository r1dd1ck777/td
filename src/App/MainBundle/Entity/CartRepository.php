<?php

namespace App\MainBundle\Entity;

class CartRepository extends EntityRepository
{
    public function findWithItems($id)
    {
        $qb = $this->createQueryBuilder($this->getAlias())
            ->select(array($this->getAlias(), 'ci', 'p'))
            ->leftJoin($this->getPropertyName('items'), 'ci')
            ->leftJoin('ci.product', 'p')
            ->where($this->getPropertyName('id').' = :id')
            ->setParameter('id' ,$id)
            ->getQuery()
            ->getSingleResult()
        ;

        return $qb;
    }
}
