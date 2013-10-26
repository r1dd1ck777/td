<?php

namespace App\MainBundle\Filter;

use App\MainBundle\Entity\Property;
use App\MainBundle\Form\BetweenType;
use App\MainBundle\Form\Choices;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Request;

class FilterField
{
    /** @var \App\MainBundle\Entity\Property */
    protected $property;
    protected $formFactory;

    public function setFormFactory($formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function addField($form, array $options = array())
    {
        $data = $this->property;
        if ($data->getType() == 'text') {
            $form->add($data->getId(), 'text', array(
                'label' => $data->getTitle(),
            ));
        }
        if ($data->getType() == 'choice_brand') {
            $form->add($data->getId(), 'entity', array(
                    'label' => $data->getTitle(),
                    'class' => 'AppMainBundle:Brand'
                )
            );
        }
        if ($data->getType() == 'choice') {
            $form->add($data->getId(), 'choice', array(
                    'label' => $data->getTitle(),
                    'choices' => Choices::get($data->getPid())
                )
            );
        }
        if ($data->getType() == 'checkbox') {
            $form->add($data->getId(), 'checkbox', array(
                    'label' => $data->getTitle(),
                )
            );
        }

        if ($data->getType() == 'integer') {
            $form->add($data->getId(), new BetweenType(), array(
                    'label' => $data->getTitle(),
                )
            );
        }
    }

    public function modifyQueryBuilder(QueryBuilder $qb, $data)
    {
        if ($data == ''){return null;}
        if ($this->property->getType() == 'integer' && $data['min']=='' && $data['max']==''){return null;}
        $id = (string)$this->property->getId();
        var_dump(array(
            "{$id}_value" => $data,
            "{$id}_property_id" => $id
        ));

        if ($this->property->getType() == 'checkbox'){
            $qb
                ->andWhere("productProperty.value = :id_{$id} AND productProperty.property = :property_id_{$id} AND productProperty.product = o.id")
                ->setParameter("id_{$id}", $data)
                ->setParameter("property_id_{$id}", $id)
                ;
        }
    }

    public function setProperty(Property $property)
    {
        $this->property = $property;
    }
}
