<?php

namespace App\AdminBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class ProductAdmin extends Admin
{
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
            ->add('category')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formBuilder = $formMapper->getFormBuilder();
        $data = $formBuilder->getData();
        $isPresent = $this->isNew($data) ? true : $data->geIsPresent();
            $formMapper
            ->with('General')
            ->add('name')
            ->add('image', 'rid_image')
            ->add('category')
            ->add('brand')
            ->add('price')
            ->add('code')
            ->add('isPresent', null, array('data' => $isPresent))
            ->add('descriptionF', 'sonata_formatter_type', array(
                'event_dispatcher' => $formBuilder->getEventDispatcher(),
                'format_field'   => 'descriptionFormatter',
                'source_field'   => 'description',
                'source_field_options'      => array(
                    'attr' => array('class' => 'span10', 'rows' => 20)
                ),
                'target_field'   => 'description',
                'listener'       => true,
            ))
            ->end();
    }

    protected function isNew($data)
    {
        return is_null($data) || is_null($data->getId());
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
            ->add('category')
            ->add('brand')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
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
            ->add('category')
            ->add('brand')
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
//        $collection->remove('create');
    }
}
