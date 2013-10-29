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

        $ridPage = $category? $category->getPage() : null;
        if ($ridPage){
            $this->get('rid_page')->setupSeo($ridPage);
        }

        $pluralName = $config->getPluralResourceName();
        $repository = $this->getRepository();

        $qb = $repository->findByCategoryId($request->get('id'));
        /** @var \App\MainBundle\Filter\ProductFilter $filter */
        $filter = $this->get('app.main.services.product_filter');
        $filterForm = $filter->buildFields($category)
            ->buildForm(is_null($request->get('q', null)))
            ->handleQuery($request, $qb)
            ->getForm();
        $resources = $repository->getPaginator($qb);

        $resources
            ->setCurrentPage($request->get('page', 1), true, true)
            ->setMaxPerPage($config->getPaginationMaxPerPage())
        ;

//        $resources = $qb->getQuery()->execute();
        if (count($resources) <=0 && is_null($request->get('f', null)) && is_null($request->get('q', null))) {
            return $this->redirect($this->generateUrl('app_main_category_show', array('id'=> $category->getId())), 301);
        }

        return $this->render('AppMainBundle:Product:list.html.twig', array(
            $pluralName => $resources,
            'category' => $category,
            'filterForm' => $filterForm->createView()
        ));
    }
}
