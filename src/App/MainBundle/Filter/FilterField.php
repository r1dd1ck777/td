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
    /** @var \App\MainBundle\Entity\ProductRepository */
    protected $repository;

    public function setRepository($repository)
    {
        $this->repository = $repository;
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
                    'choices' => Choices::get($data->getPid()),
                    'attr' => array('class' => 'f-select2')
                )
            );
        }
        if ($data->getType() == 'checkbox') {
            $form->add($data->getId(), 'checkbox', array(
                    'label' => $data->getTitle(),
                    'attr' => array('class' => 'f-checkbox')
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

        $joinAlias = "pp_{$id}";
        $idParam = "property_id_{$id}";
        $valueParam = "value_{$id}";
        $type = $this->property->getType();

        if (in_array($type, array('checkbox', 'choice'))){
            $qb
                ->leftJoin("o.productProperties", $joinAlias)
                ->andWhere("{$joinAlias}.property = :$idParam AND {$joinAlias}.value = :$valueParam")
                ->setParameter($valueParam, $data)
                ->setParameter($idParam, $id)
                ;
        }

        if (in_array($type, array('text'))){
            $qb
                ->leftJoin("o.productProperties", $joinAlias)
                ->andWhere("{$joinAlias}.property = :$idParam AND {$joinAlias}.value LIKE :$valueParam")
                ->setParameter($valueParam, "%{$data}%")
                ->setParameter($idParam, $id)
            ;
        }

        if (in_array($type, array('integer'))){
            $qb
                ->leftJoin("o.productProperties", $joinAlias)
                ->andWhere($this->getBetweenWhere("{$joinAlias}.value", $data, $joinAlias, $idParam))
//                ->setParameter($valueParam, $data['min'])
//                ->setParameter($valueParamMax, $data['max'])
                ->setParameter($idParam, $id)
            ;
        }
    }

    public function getBetweenWhere($field, $data, $joinAlias, $idParam)
    {
        if (empty($data['min']) && empty($data['max'])){return null;}
        if ($data['min'] == '' && $data['max'] != ''){
            return "{$joinAlias}.property = :$idParam AND {$field} <= {$data['max']}";
        }
        if ($data['min'] != '' && $data['max'] == ''){
            return "{$joinAlias}.property = :$idParam AND {$field} >= {$data['min']}";
        }

        return "{$joinAlias}.property = :$idParam AND {$field} BETWEEN {$data['min']} AND {$data['max']}";
    }

    public function setProperty(Property $property)
    {
        $this->property = $property;
    }
}
