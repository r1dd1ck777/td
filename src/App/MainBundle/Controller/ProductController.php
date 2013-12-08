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

        if (!is_null($category)){
            $seoPage = $this->get('sonata.seo.page');
            $seoPage->setTitle("{$category->getName()} | купить {$category->getName()} Черкассы");
            $seoPage->addMeta('name', 'description', "093 731-85-03 | Звоните нам, чтобы купить {$category->getName()} в городе Черкассы. Доставим в любой уголок города");
        }

        return $this->render('AppMainBundle:Product:list.html.twig', array(
            $pluralName => $resources,
            'category' => $category,
            'filterForm' => $filterForm->createView()
        ));
    }

    /**
     * Get single resource by its identifier.
     */
    public function showAction()
    {
        $config = $this->getConfiguration();

        $view =  $this
            ->view()
            ->setTemplate($config->getTemplate('show.html'))
            ->setTemplateVar($config->getResourceName())
            ->setData($this->findOr404())
        ;

        return $this->handleView($view);
    }
}
