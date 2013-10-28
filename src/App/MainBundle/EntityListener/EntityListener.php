<?php

namespace App\MainBundle\EntityListener;

use App\MainBundle\Entity\Brand;
use App\MainBundle\Entity\Category;
use App\MainBundle\Entity\Page;
use App\MainBundle\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;

class EntityListener
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Category) {
            return;
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Category) {
            return;
        }
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();
        if ($entity instanceof Brand) {
            foreach($entity->getCategories() as $category){
                $category->getBrands()->clear();
                $em->persist($category);
            }
            foreach($entity->getProducts() as $product){
                $product->setBrand(null);
                $em->persist($product);
            }
        }
    }
}
