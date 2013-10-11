<?php

namespace App\AdminBundle\Controller;

use App\MainBundle\Form\XlsType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\SecurityContext;

class XlsController extends CoreController
{
    public function statusAction()
    {
        /** @var \App\MainBundle\Services\XlsImport $xls */
        $xls = $this->get('app.main.services.xls_import');

        $status = array(
            'total' => $xls->total(),
            'done' => $xls->done(),
            'status' => $xls->status()
        );

        return new JsonResponse($status);
    }

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
        if (!isset($data['file']) || !$form->isValid()) {
            return $response;
        }
        /** @var \App\MainBundle\Services\XlsImport $xls */
        $xls = $this->get('app.main.services.xls_import');
        /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $file */
        $file = $data['file'];
        if ($file->getClientMimeType() !== 'application/vnd.ms-excel' || $xls->status()) {
            return $response;
        }
        $file->move($xls->generateTmpDir(), $xls->generateTmpFilename());
//        $xls->createFrom($xls->tmpDir.$xls->tmpFilename);
//        $xls->import(1200, 1700);
//        die;
        $cmd = "php ../app/console app:admin:import_supervizor --xls=".$xls->tmpDir.$xls->tmpFilename;
        exec(sprintf("%s > %s 2>&1 & echo $! >> %s", $cmd, '../app/logs/import.log', '../app/logs/import.pid'));
        $xls->status(true);
        $xls->done(0);

        $this->addFlash('sonata_flash_success', 'Загружено. Возможно придется подождать.');

        return $this->redirect($this->generateUrl('app_admin_xls_form'));
    }

    protected function  getForm($data = array(), array $options = array())
    {
        return $this->createForm(new XlsType(), $data, $options);
    }
}
