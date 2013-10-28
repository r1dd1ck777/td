<?php

namespace App\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;

class BrandCheckboxesType extends AbstractType
{
    protected $repository;

    /**
     * @param mixed $repository
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null
        ));

        $resolver->setRequired(array(
            'categoryId'
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $brands = $this->repository->findByCategoryId($options['categoryId'])->getQuery()->execute();
        foreach($brands as $brand){
            $builder->add($brand->getId(), 'checkbox', array(
                'label' => $brand->getName(),

            ));
        }
    }

    public function getName()
    {
        return 'brand_checkboxes';
    }
}
