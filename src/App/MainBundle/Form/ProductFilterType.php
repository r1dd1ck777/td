<?php

namespace App\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

class ProductFilterType extends AbstractType
{
    public function __construct()
    {
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null
        ));

        $resolver->setOptional(array(
            'properties' => array()
        ));

        $resolver->setRequired(array(
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'Цена'
            ))
            ->add('price', 'text', array(
                'label' => 'Цена'
            ))
        ;
    }

    public function getName()
    {
        return 'f';
    }
}
