<?php

namespace App\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

class FilterType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
        ));
        $resolver->setRequired(array(
            'withBrands'
        ));
    }

    public function addField(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('submit', 'submit', array(
                'label' => 'Отправить',
                'attr' => array(
                    'class' => 'btn td-btn'
                )
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['withBrands'] = $options['withBrands'];
    }

    public function getName()
    {
        return 'product_filter';
    }
}
