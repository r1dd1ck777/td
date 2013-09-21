<?php

namespace App\AdminBundle\Controller;

use App\MainBundle\Form\XlsType;
use Symfony\Component\Security\Core\SecurityContext;

class XlsController extends CoreController
{
    public function formAction()
    {
        $form = $this->getForm(null, array(
            'action' => $this->generateUrl('app_admin_xls_save'),
            'method' => 'POST',
        ));

        return $this->render('AppAdminBundle:Xls:edit.html.twig' , array(
            'last_username' => $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME),
            'base_template'   => $this->getBaseTemplate(),
            'admin_pool'      => $this->container->get('sonata.admin.pool'),
            'form'         => $form,
        ));
    }

    public function saveAction()
    {
        $form = $this->getForm(null, array(
            'action' => $this->generateUrl('app_admin_xls_save'),
            'method' => 'POST',
        ));

        $response = $this->render('AppAdminBundle:Xls:edit.html.twig' , array(
            'last_username' => $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME),
            'base_template'   => $this->getBaseTemplate(),
            'admin_pool'      => $this->container->get('sonata.admin.pool'),
            'form'         => $form,
        ));

        $form->handleRequest($this->getRequest());
        $data = $form->getData();
        if (!$data['file']){
            return $response;
        }
        /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $file */
        $file = $data['file'];
        if ($file->getClientMimeType() !== 'application/vnd.ms-excel'){
            return $response;
        }

        return $response;
    }

    protected function  getForm($data = array(), array $options = array())
    {
        return $this->createForm(new XlsType(), $data, $options);
    }
}
