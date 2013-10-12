<?php

namespace App\MainBundle\Controller;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;

class ProductController extends ResourceController
{
    public function listAction()
    {
        $request=$this->getRequest();
        $config = $this->getConfiguration();

        $category = $this->get('app.repository.category')->find((int)$request->get('id'));

        $pluralName = $config->getPluralResourceName();
        $repository = $this->getRepository();

        $qb = $repository->findByCategoryId($category->getId());
        $resources = $repository->getPaginator($qb);

        $resources
            ->setCurrentPage($request->get('page', 1), true, true)
            ->setMaxPerPage($config->getPaginationMaxPerPage())
        ;

        if (count($resources) <=0) {
            return $this->redirect($this->generateUrl('app_main_category_show', array('id'=> $category->getId())));
        }

        return $this->render('AppMainBundle:Product:list.html.twig', array(
            $pluralName => $resources,
            'category' => $category
        ));
    }
}
