<?php

namespace App\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

class MentionType extends AbstractType
{
    protected $securityContext;

    public function setSecurityContext($securityContext)
    {
        $this->securityContext = $securityContext;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\MainBundle\Entity\Mention',
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
            ->add('email', 'email', array(
                'label' => 'E-mail',
                'attr' => array(
                    'placeholder' => 'E-mail *'
                )
            ))
            ->add('comments', 'textarea', array(
                'label' => 'Отзыв *',
                'attr' => array(
                    'placeholder' => 'Отзыв'
                )
            ))
            ->add('product')
            ->add('submit', 'submit', array(
                'label' => 'Отправить',
                'attr' => array(
                    'class' => 'btn td-btn-bay pull-right'
                )
            ))
        ;
    }

    public function getName()
    {
        return 'app_mention';
    }
}
