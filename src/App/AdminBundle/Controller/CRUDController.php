<?php

namespace App\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sonata\AdminBundle\Controller\CRUDController as BaseCRUDController;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CRUDController extends BaseCRUDController
{
    protected function getSingleObject($access = 'VIEW')
    {
        $id     = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted($access, $object)) {
            throw new AccessDeniedException();
        }

        return $object;
    }

    protected function createStreamedFileResponse($file, $filename)
    {
//        $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'wave-speed-report.xls');
        return new StreamedResponse(function () use ($file) {
            readfile($file);
        }, 200, array(
            'Content-length', filesize($file),
            'Content-Type' => mime_content_type($file),
            'Content-Disposition' => 'attachment; filename='.$filename
        ));
    }
}
