<?php

namespace App\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

class FeedbackType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'Имя:'
            ))
            ->add('email', 'text', array(
                'label' => 'E-mail:'
            ))
            ->add('phone', 'text', array(
                'label' => 'Телефон:'
            ))
            ->add('message', 'textarea', array(
                'label' => 'Сообщение:'
            ))
            ->add('submit', 'submit', array(
                'label' => 'Отправить',
                'attr' => array(
                    'class' => 'btn td-btn'
                )
            ))
        ;
    }

//    public function getParent()
//    {
//        return 'text';
//    }

    public function getName()
    {
        return 'app_feedback';
    }
}
