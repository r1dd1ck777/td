<?php

namespace App\AdminBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class ProductAdmin extends Admin
{
    /** @var \Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository $categoryRepository */
    protected $categoryRepository;

    protected $session;
    protected $prototypeRepository;

    public function setSession($session)
    {
        $this->session = $session;
    }

    public function setPrototypeRepository($prototypeRepository)
    {
        $this->prototypeRepository = $prototypeRepository;
    }

    public function setCategoryRepository($categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function getNewInstance()
    {
        $object = $this->getModelManager()->getModelInstance($this->getClass());
        foreach ($this->getExtensions() as $extension) {
            $extension->alterNewInstance($this, $object);
        }

        $prototype = $this->prototypeRepository->find($this->session->get('prototype'));
        if ($prototype) {
            $object->mergeProperties($prototype);
        }

        return $object;
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
        $categories = $this->categoryRepository->findBottom()->getQuery()->execute();

        $formBuilder = $formMapper->getFormBuilder();
        $data = $this->getSubject();
        $isPresent = $this->isNew($data) ? true : $data->getIsPresent();
        $formMapper
            ->with('General')
            ->add('name')

            ->add('category', null, array(
                'choices' => $categories
            ))
            ->add('brand')
            ->add('price', 'integer')
            ->add('code')
            ->add('info')
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

            ->end()
            ->with('Images')
            ->add('image', 'rid_image')
            ->add('image2', 'rid_image')
            ->add('image3', 'rid_image')
            ->add('image4', 'rid_image')
            ->end()
            ->with('Properties')
            ->add('productProperties', 'collection', array(
                    'type'         => 'app_product_property',
//                    'allow_add'    => true,
//                    'allow_delete'    => true,
                    'label' => 'Параметры',
                    'required' => false,
                    'data' => $data->getProductProperties()
                )
            )
            ->end()
        ;
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

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'AppAdminBundle:Product:edit.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
}
