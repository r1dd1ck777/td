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

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $categories = $this->repository->findBy(array('category' => $options['categoryId']));
        foreach($categories as $category){

        }
    }

    public function getName()
    {
        return 'brand_checkboxes';
    }
}
