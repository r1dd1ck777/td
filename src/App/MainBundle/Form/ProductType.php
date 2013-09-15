<?php

namespace App\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('image', 'rid_image')
            ->add('category')
            ->add('brand')
            ->add('price')
            ->add('code')
            ->add('isPresent', null)
            ->add('descriptionF', 'sonata_formatter_type', array(
                'event_dispatcher' => $builder->getEventDispatcher(),
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
                )
            )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\MainBundle\Entity\Product'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_mainbundle_product';
    }
}
