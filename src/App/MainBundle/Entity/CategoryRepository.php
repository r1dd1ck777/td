<?php

namespace App\MainBundle\Entity;

class CategoryRepository extends EntityRepository
{
    public function findTop()
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.parent IS NULL')
            ;

        return $qb;
    }
}
