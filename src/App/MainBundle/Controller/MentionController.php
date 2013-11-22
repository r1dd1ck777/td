<?php

namespace App\MainBundle\Controller;

use Sylius\Bundle\ResourceBundle\Controller\Configuration;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MentionController extends BaseCardController
{
    public function __construct($bundlePrefix='app', $resourceName='mention', $templateNamespace='AppMainBundle:Mention', $templatingEngine = 'twig')
    {
        $this->configuration = new Configuration($bundlePrefix, $resourceName, $templateNamespace, $templatingEngine);
        $this->configured = false;
    }

    /**
     * Create new resource or just display the form.
     */
    public function createAction(Request $request)
    {
        $response = $this->redirect($request->headers->get('referer'));
        $resource = $this->createNew();
        $form = $this->getForm($resource);

        if (!$form->bind($request)->isValid()) {
            return $response;
        }

        $product = $this->get('app.repository.product')->find($request->get('id'));
        $resource->setProduct($product);

        if($this->getSecurityContext()->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            $resource->setuser($this->getUser());
        }

        $this->get('rid_image')->ignorePreFlush = true;
        $this->create($resource);
        $this->addFlash('notice', 'Спасибо за отзыв.');

        return $response;
    }

    public function formAction(Request $request)
    {
        $product = $this->get('app.repository.product')->find($request->get('id'));
        $resource = $this->createNew();
        $resource->setProduct($product);
        if($this->getSecurityContext()->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            $resource->setFio($this->getUser()->getUsername());
            $resource->setEmail($this->getUser()->getEmail());
        }
        $form = $this->getForm($resource);

        return $this->render('AppMainBundle:Mention:_form.html.twig', array(
            'form' => $form->createView(),
            'id' => $request->get('id')
        ));
    }
}
