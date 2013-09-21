<?php

namespace App\AdminBundle\Controller;

class PrototypeController extends CRUDController
{
    public function createProductAction()
    {
        $id = $this->getRequest()->get('id');

        $session = $this->get('session');
        $session->set('prototype', $id);

        return $this->redirect($this->generateUrl('admin_app_main_product_create'));
    }
}
