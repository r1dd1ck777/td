<?php

namespace App\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class OrderController extends CRUDController
{
    public function statusAction(Request $request)
    {
        $object = $this->getSingleObject();
        $object->setStatus($request->get('status'));

        $em = $this->get('doctrine.orm.entity_manager');
        $em->persist($object);
        $em->flush($object);

        return $this->redirect($request->headers->get('referer'));
    }
}
