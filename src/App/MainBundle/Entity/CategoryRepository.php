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

    public function findWithPrototypes()
    {
        $qb = $this->createQueryBuilder($this->getAlias())
            ->select(array($this->getAlias(), 'p'))
            ->leftJoin($this->getPropertyName('prototypes'), 'p')
        ;

        return $qb;
    }

//    public function findWithoutPrototype()
//    {
//        $qb = $this->createQueryBuilder($this->getAlias());
//        $qb2 = $this->_em->createQueryBuilder();
//        $qb
//            ->where(
//                $qb->expr()->notIn(
//                    $this->getPropertyName('id'),
//                    $qb2
//                        ->select('c2')
//                        ->from('AppMainBundle:Category', 'c2')
//                        ->leftJoin("c2.prototypes", 'p')
//                        ->getDQL()
//                )
//            )
//        ;
//
//        return $qb;
//    }
}
