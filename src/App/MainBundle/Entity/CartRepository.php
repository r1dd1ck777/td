<?php

namespace App\MainBundle\Entity;

class CartRepository extends EntityRepository
{
    public function findWithItems($id)
    {
        $qb = $this->createQueryBuilder('c')
            ->select(array('c', 'ci', 'p'))
            ->leftJoin('c.items', 'ci')
            ->leftJoin('ci.product', 'p')
            ->where('c.id = :id')
            ->setParameter('id' ,$id)
            ->getQuery()
            ->getSingleResult()
        ;

        return $qb;
    }
}
