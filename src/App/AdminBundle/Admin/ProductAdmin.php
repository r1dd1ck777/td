<?php

namespace App\AdminBundle\Admin;

use App\MainBundle\Entity\ProductProperty;
use App\MainBundle\Entity\Property;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class ProductAdmin extends Admin
{
    /** @var \Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository $categoryRepository */
    protected  $categoryRepository;

    public function setCategoryRepository($categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
//    protected $form;
//
//    protected function buildForm()
//    {
//        if ($this->form) {
//            return;
//        }
//
//        // append parent object if any
//        // todo : clean the way the Admin class can retrieve set the object
//        if ($this->isChild() && $this->getParentAssociationMapping()) {
//            $parent = $this->getParent()->getObject($this->request->get($this->getParent()->getIdParameter()));
//
//            $propertyAccessor = PropertyAccess::getPropertyAccessor();
//            $propertyPath = new PropertyPath($this->getParentAssociationMapping());
//
//            $object = $this->getSubject();
//
//            $propertyAccessor->setValue($object, $propertyPath, $parent);
//        }
//
//        $this->form = $this->getFormBuilder()->getForm();
//    }

    /**
     * {@inheritdoc}
     */
    public function getNewInstance()
    {
        $object = $this->getModelManager()->getModelInstance($this->getClass());
        foreach($this->getExtensions() as $extension) {
            $extension->alterNewInstance($this, $object);
        }

        $p = new Property();
        $p->setName('prop');
        $p->setType('1');

        $pp = new ProductProperty();
        $pp->setProperty($p);
        $pp->setProduct($object);

        $object->addProductPropertie($pp);

        $p = new Property();
        $p->setName('prop2');
        $p->setType('2');

        $pp = new ProductProperty();
        $pp->setProperty($p);
        $pp->setProduct($object);

        $object->addProductPropertie($pp);

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
            ->add('image', 'rid_image')
            ->add('category', null, array(
                'choices' => $categories
            ))
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
            ->add('productProperties', 'collection', array(
                    'type'         => 'app_product_property',
                    'allow_add'    => false,
                    'allow_delete'    => false,
                    'label' => 'Параметры',
                    'data' => $data->getProductProperties()
                )
            )
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
