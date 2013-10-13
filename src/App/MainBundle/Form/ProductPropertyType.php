<?php

namespace App\MainBundle\Form;

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
            $data = $event->getData();
            if (is_null($data)) {
                // add from prototype
                return;
            }
            $form = $event->getForm();
            if ($data->getType() == 'text') {
                $form->add('value', 'text', array(
                    'label' => $data->getTitle(),
                    'required' => false
                ));
            }
            if ($data->getType() == 'choice_brand') {
                $form->add('value', 'entity', array(
                        'label' => $data->getTitle(),
                        'required' => false,
                        'class' => 'AppMainBundle:Brand'
                    )
                );
            }
            if ($data->getType() == 'choice') {
                $form->add('value', 'choice', array(
                        'label' => $data->getTitle(),
                        'required' => false,
                        'choices' => Choices::get($data->getPid())
                    )
                );
            }
//            if ($data->getType() == 'checkbox') {
//                $form->add('value', 'checkbox', array(
//                        'label' => $data->getTitle(),
//                        'required' => false,
//                    )
//                );
//            }

            if ($data->getType() == 'integer') {
                $form->add('value', 'integer', array(
                        'label' => $data->getTitle(),
                        'required' => false,
                    )
                );
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
        if (is_null($data)) {return;}

        $view->vars['type'] = $data->getType();
    }
}
