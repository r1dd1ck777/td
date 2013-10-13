<?php

namespace App\AdminBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class PrototypeAdmin extends Admin
{
   protected $categoryRepository;

    public function setCategoryRepository($categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('properties')
            ->add('categories')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $categories = $this->categoryRepository->findWithPrototypes()->getQuery()->execute();
        if (is_array($categories)){
            $categories = array_filter($categories, function($c){
                return $c->getPrototypes()->count() <= 0 || $c->getPrototypes()->contains($this->getSubject());
            });
        }
        $formMapper
            ->with('General')
            ->add('name')
            ->add('properties', 'entity', array(
                'class' => 'AppMainBundle:Property',
                'property' => 'fullName',
                'multiple' => true
            ))
            ->add('categories', 'entity', array(
                'class' => 'AppMainBundle:Category',
                'multiple' => true,
                'choices' => $categories
            ))
            ->end();
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('properties')
            ->add('categories')
            ->add('create_product', 'string', array('template' => 'AppAdminBundle:Prototype:_create_product.html.twig'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('createProduct', $this->getRouterIdParameter().'/create_product' );
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     *
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
        ;
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'AppAdminBundle:Prototype:edit.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
}
