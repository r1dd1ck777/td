<?php

namespace App\MainBundle\Entity;

use Doctrine\ORM\NonUniqueResultException;

class PrototypeRepository extends EntityRepository
{
    public function getOneByCategoryName($name)
    {
        $qb = $this->createQueryBuilder('o')
            ->select(array('o'))
            ->leftJoin('o.categories', 'c')
            ->where('c.name = :name')
            ->setParameter('name', $name)
        ;

        try {
            $object = $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            $object = null;
        } catch (NonUniqueResultException $e){
            $objects = $qb->getQuery()->execute();
            $object = reset($objects);
        }

        return $object;
    }
}
