<?php

namespace App\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductProperty
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ProductProperty
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Property", cascade={"persist"})
     * @ORM\JoinColumn(name="property_id", nullable=false)
     */
    private $property;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="productProperties")
     * @ORM\JoinColumn(name="product_id", nullable=false)
     */
    private $product;

    public function getType()
    {
        return $this->getProperty()->getType();
    }

    //--

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return ProductProperty
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set property
     *
     * @param \App\MainBundle\Entity\Property $property
     * @return ProductProperty
     */
    public function setProperty(\App\MainBundle\Entity\Property $property)
    {
        $this->property = $property;
    
        return $this;
    }

    /**
     * Get property
     *
     * @return \App\MainBundle\Entity\Property 
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Set product
     *
     * @param \App\MainBundle\Entity\Product $product
     * @return ProductProperty
     */
    public function setProduct(\App\MainBundle\Entity\Product $product)
    {
        $this->product = $product;
    
        return $this;
    }

    /**
     * Get product
     *
     * @return \App\MainBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
}