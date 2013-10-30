<?php

namespace App\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CategoryController extends CRUDController
{
    public function priorityAction(Request $request)
    {
        $object = $this->getSingleObject();
        $object->setPriority((float)$request->get('value'));

        $em = $this->get('doctrine.orm.entity_manager');
        $em->persist($object);
        $em->flush($object);

        return $this->redirect($request->headers->get('referer'));
    }
}
