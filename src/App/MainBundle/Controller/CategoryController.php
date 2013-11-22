<?php

namespace App\MainBundle\Controller;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;

class CategoryController extends ResourceController
{
    /**
     * Get single resource by its identifier.
     */
    public function showAction()
    {
        $config = $this->getConfiguration();
        $category = $this->findOr404();
        if ($category->getProducts()->count() > 0){
            return $this->redirect($this->generateUrl('app_main_product_list', array('id'=>$category->getId())), 301);
        }
        $seoPage = $this->get('sonata.seo.page');
        $seoPage->setTitle("{$category->getName()} | купить {$category->getName()} Черкассы");
        $seoPage->addMeta('name', 'description', "093 731-85-03 | Звоните нам, чтобы купить {$category->getName()} в городе Черкассы. Доставим в любой уголок города");

        $view =  $this
            ->view()
            ->setTemplate($config->getTemplate('show.html'))
            ->setTemplateVar($config->getResourceName())
            ->setData($category)
        ;

        return $this->handleView($view);
    }
}
