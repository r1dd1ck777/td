<?php

namespace App\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

class OrderType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\MainBundle\Entity\Order',
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fio', 'text', array(
                'label' => 'ФИО *',
                'attr' => array(
                    'placeholder' => 'ФИО *'
                )
            ))
            ->add('town', 'text', array(
                'label' => 'Город *',
                'attr' => array(
                    'placeholder' => 'Город *'
                )
            ))
            ->add('address', 'text', array(
                'label' => 'Адрес *',
                'attr' => array(
                    'placeholder' => 'Адрес *'
                )
            ))
            ->add('phone', 'text', array(
                'label' => 'Телефон *',
                'attr' => array(
                    'placeholder' => 'Телефон *'
                )
            ))
            ->add('email', 'text', array(
                'label' => 'E-mail *',
                'attr' => array(
                    'placeholder' => 'E-mail *'
                )
            ))
            ->add('paymentType', 'choice', array(
                'label' => 'Способ оплаты: *',
                'choices' => array(
                    'Наличными при получении' => 'Наличными при получении',
                    'На банковскую карту (Visa, MasterCard, Amex)' => 'На банковскую карту (Visa, MasterCard, Amex)'
                )
            ))
            ->add('comments', 'textarea', array(
                'label' => 'Примечания к заказу: *',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'Примечания к заказу *'
                )
            ))
            ->add('deliveryType', 'choice', array(
                'label' => 'Способ доставки: *',
                'choices' => array(
                    'Нова пошта' => 'Нова пошта'
                )
            ))
            ->add('submit', 'submit', array(
                'label' => 'Дальше',
                'attr' => array(
                    'class' => 'btn td-btn-bay pull-right'
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
        return 'app_order';
    }
}
