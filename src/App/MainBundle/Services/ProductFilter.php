<?php

namespace App\MainBundle\Services;

use App\MainBundle\Entity\ProductRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Request;

class ProductFilter
{
    /** @var \App\MainBundle\Entity\ProductRepository */
    protected $repository;

    public function setRepository(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getForm($category)
    {
        if (is_null($category)){
            return;
        }
        $prototype = $category->getPrototype();
        foreach($prototype->getProperties() as $property){
//            var_dump($property->getType() . $property->getPid(). $property->getTitle());
        }
    }

    public function handleQuery(Request $request, QueryBuilder $qb)
    {
        $q = $request->get('q', false);
        if ($q){
            $this->repository->mqSearch($q, $qb);
        }
    }
}
