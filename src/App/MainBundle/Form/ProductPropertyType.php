<?php

namespace App\MainBundle\Form;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;

class ProductPropertyType extends AbstractType
{
    public function __construct()
    {
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\MainBundle\Entity\ProductProperty'
        ));

        $resolver->setOptional(array(
        ));

        $resolver->setRequired(array(
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event){
            $type = $event->getData()->getType();
            $form = $event->getForm();

            if ($type == 'type'){
                $form->add('value', 'text');
            }
            if ($type == '1'){
                $form->add('value', 'text');
            }
            if ($type == '2'){
                $form->add('value', 'integer');
            }
        });
    }

//    public function getParent()
//    {
//        return 'text';
//    }

    public function getName()
    {
        return 'app_product_property';
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $data = $form->getData();

        $view->vars['type'] = $data->getType();
    }
}
