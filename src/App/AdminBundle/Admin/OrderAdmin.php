<?php

namespace App\AdminBundle\Admin;

use App\MainBundle\Entity\Order;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;

class OrderAdmin extends Admin
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
//            ->add('status')
            ->add('createdAt')
            ->add('user')
            ->add('fio')
            ->add('email')
            ->add('phone')
            ->add('address')
            ->add('paymentType')
            ->add('deliveryType')
            ->add('comments')
            ->add('cart', 'string', array(
                'template' => 'AppAdminBundle:Order/partials:_show.cart.html.twig',
            ))
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
            ->add('status')
            ->add('fio')
            ->add('email')
            ->add('phone')
            ->add('address')
            ->add('paymentType')
            ->add('deliveryType')
            ->add('comments')
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
            ->add('fio')
            ->add('email')
            ->add('comments')
            ->add('createdAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                    'toggleArchive' => array('template' => 'AppAdminBundle:Order/partials:_action.status.html.twig')
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
            ->add('statusNew', 'doctrine_orm_callback', array(
                'label'         => 'Только новые',
                'callback'      => array($this, 'filterStatusNew'),
                'field_type'    => 'checkbox',
            ))
            ->add('id')
            ->add('fio')
            ->add('email')
            ->add('comments')
            ->add('status', 'doctrine_orm_callback', array(
                'label'         => 'Показать незавершенные',
                'callback'      => array($this, 'filterStatus'),
                'field_type'    => 'checkbox',
            ))
        ;
    }

    public function filterStatus(ProxyQuery $queryBuilder, $alias, $field, $value)
    {
        $queryBuilder = $queryBuilder->getQueryBuilder();
        $value = trim($value['value']);
        if ($value) {
            $queryBuilder->andWhere("{$alias}.status = :status");
        }else{
            $queryBuilder->andWhere("{$alias}.status <> :status");
        }
        $queryBuilder->setParameter('status', Order::STATUS_NOT_READY);
    }

    public function filterStatusNew(ProxyQuery $queryBuilder, $alias, $field, $value)
    {
        $queryBuilder = $queryBuilder->getQueryBuilder();
        $value = trim($value['value']);
        if ($value) {
            $queryBuilder->andWhere("{$alias}.status = :statusNew");
            $queryBuilder->setParameter('statusNew', Order::STATUS_NEW);
        }
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        $collection->add('status', $this->getRouterIdParameter(). '/status' );
    }
}
