<?php

namespace App\MainBundle\Filter;

use App\MainBundle\Entity\Category;
use App\MainBundle\Entity\ProductRepository;
use App\MainBundle\Form\BetweenType;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\FormFactory;

class ProductFilter
{
    /** @var \App\MainBundle\Entity\ProductRepository */
    protected $repository;
    protected $fields;
    protected $form;
    /** @var \Symfony\Component\Form\FormFactory */
    protected $formFactory;

    public function setFormFactory(FormFactory $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function __construct()
    {
    }

    public function setRepository(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function buildFields($category)
    {
        $this->fields = array();
        if (is_null($category)){
            return $this;
        }
        /** @var \App\MainBundle\Entity\Category $category */
        $prototype = $category->getPrototype();
        if (!$prototype){return $this;}
        foreach($prototype->getProperties() as $property){
            $this->fields[$property->getId()] = $this->createFilterField($property);
        }

        return $this;
    }

    public function getForm()
    {
        if ($this->form){
            return $this->form;
        }
        $formBuilder = $this->formFactory->createNamedBuilder('f' ,'product_filter', null, array('required' => false, 'method' => 'GET', 'csrf_protection' => false));
        $formBuilder->add('name','text', array(
            'label' => 'Название:'
        ));
        $formBuilder->add('price', new BetweenType(), array(
            'label' => 'Цена:'
        ));
        foreach($this->fields as $field){ $field->addField($formBuilder); }

        $this->form = $formBuilder->getForm();
        return $this->form;
    }

    public function handleQuery(Request $request, QueryBuilder $qb)
    {
        // global search
        $q = $request->get('q', false);
        if ($q){
            $this->repository->mqSearch($q, $qb);
        }

        $formData = $request->get($this->getForm()->getName(), array());
        $this->getForm()->submit($formData);

        // common params
        if(isset($formData['name'])){$this->repository->mqName($formData['name'], $qb);}
        if(isset($formData['price'])){$this->repository->mqPrice($formData['price'], $qb);}

        // uncommon params
        foreach($formData as  $fieldKey => $fieldData){
            if (!isset($this->fields[$fieldKey])){continue;}
            $this->fields[$fieldKey]->modifyQueryBuilder($qb, $fieldData);
        }

        return $this;
    }

    public function createFilterField($property)
    {
        $filterField = new FilterField();
        $filterField->setProperty($property);

        return $filterField;
    }
}
