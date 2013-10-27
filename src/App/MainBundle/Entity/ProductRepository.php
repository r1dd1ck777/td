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

    public function getBetweenWhere($field, $data)
    {
        if (empty($data['min']) && empty($data['max'])){return null;}
        if ($data['min'] == '' && $data['max'] != ''){
            return "{$field} <= {$data['max']}";
        }
        if ($data['min'] != '' && $data['max'] == ''){
            return "{$field} >= {$data['min']}";
        }
        return "{$field} BETWEEN {$data['min']} AND {$data['max']}";
    }

    public function mqPrice($data, QueryBuilder $qb)
    {
        $where = $this->getBetweenWhere($this->getPropertyName('price'), $data, $qb);
        $qb->andWhere($where);
    }

    public function mqName($data, QueryBuilder $qb)
    {
        $qb
            ->andWhere("{$this->getPropertyName('name')} LIKE :name")
            ->setParameter('name', "%{$data}%")
        ;
    }
}
