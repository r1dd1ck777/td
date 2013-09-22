<?php

namespace App\AdminBundle\Controller;

use Sonata\AdminBundle\Controller\CoreController as BaseCoreController;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CoreController extends BaseCoreController
{
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

    public function addFlash($type, $message)
    {
        $this->get('session')
            ->getFlashBag()
            ->add($type, $message);
    }
}
