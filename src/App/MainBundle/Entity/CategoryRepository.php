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

    public function findBottom()
    {
        $qb = $this->createQueryBuilder('c');
        $qb2 = $this->_em->createQueryBuilder();
        $qb
            ->where(
                $qb->expr()->notIn(
                    'c.id',
                    $qb2->select('IDENTITY(c2.parent)')
                        ->from('AppMainBundle:Category', 'c2')
                        ->where('c2.parent IS NOT NULL')
                        ->getDQL()
                )
            )
        ;

        return $qb;
    }
}
