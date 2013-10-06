<?php

namespace App\MainBundle\Controller;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;

class ProductController extends ResourceController
{
    public function listAction()
    {
        $request=$this->getRequest();
        $config = $this->getConfiguration();

        $criteria = $config->getCriteria();
        $sorting = $config->getSorting();

        $pluralName = $config->getPluralResourceName();
        $repository = $this->getRepository();

        if ($config->isPaginated()) {
            $resources = $this
                ->getResourceResolver()
                ->getResource($repository, $config, 'createPaginator', array($criteria, $sorting))
            ;

            $resources
                ->setCurrentPage($request->get('page', 1), true, true)
                ->setMaxPerPage($config->getPaginationMaxPerPage())
            ;
        } else {
            $resources = $this
                ->getResourceResolver()
                ->getResource($repository, $config, 'findBy', array($criteria, $sorting, $config->getLimit()))
            ;
        }

        if (count($resources) <=0) {
            return $this->redirect($this->generateUrl('app_main_category_show', array('id'=> $request->get('id'))));
        }

        $view = $this
            ->view()
            ->setTemplate($config->getTemplate('index.html'))
            ->setTemplateVar($pluralName)
            ->setData($resources)
        ;

        return $this->handleView($view);
    }
}
