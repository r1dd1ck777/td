<?php

namespace App\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

class XlsType extends AbstractType
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
        ));

        $resolver->setRequired(array(
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', 'file', array(
                'label' => 'Файл'
            ))
            ->add('submit', 'submit', array(
                'label' => 'Импортировать'
            ))
        ;
    }

//    public function getParent()
//    {
//        return 'text';
//    }

    public function getName()
    {
        return 'app_xls';
    }
}
