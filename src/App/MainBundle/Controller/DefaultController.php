<?php

namespace App\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppMainBundle:Default:index.html.twig');
    }

    public function renderCategoryMenuAction()
    {
        /** @var \Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository $repository */
        $repository = $this->get('app.repository.category');
        $categories = $repository->findTop()->getQuery()->execute();

        return $this->render('AppMainBundle:Default/partials:_category_menu.html.twig',
            array('categories' => $categories)
        );
    }
}
