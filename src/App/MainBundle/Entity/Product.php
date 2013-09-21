<?php

namespace App\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Rid\Bundle\ImageBundle\Model\RidImage;

/**
 * Product
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Product
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(name="descriptionFormatter", type="string", length=50)
     */
    private $descriptionFormatter;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="code", type="integer")
     */
    private $code;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isPresent", type="boolean", nullable=true)
     */
    private $isPresent;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", nullable=true)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="Brand", inversedBy="products")
     * @ORM\JoinColumn(name="brand_id", nullable=true)
     */
    private $brand;

    /**
     * @ORM\Column(type="rid_image", length=255, options={"default" = ""})
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="ProductProperty", mappedBy="product", cascade={"persist", "remove"})
     */
    protected $productProperties;

    public $selectedPrototype;

    public function __construct()
    {
        $this->selectedPrototype = new  Prototype();
        $this->image = new RidImage();
    }

    public function setImage(RidImage $image)
    {
        $this->image = $image;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
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
     * Set name
     *
     * @param  string  $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param  string  $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param  float   $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set code
     *
     * @param  integer $code
     * @return Product
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set isPresent
     *
     * @param  boolean $isPresent
     * @return Product
     */
    public function setIsPresent($isPresent)
    {
        $this->isPresent = $isPresent;

        return $this;
    }

    /**
     * Get isPresent
     *
     * @return boolean
     */
    public function getIsPresent()
    {
        return $this->isPresent;
    }

    /**
     * Set category
     *
     * @param  \App\MainBundle\Entity\Category $category
     * @return Product
     */
    public function setCategory(\App\MainBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \App\MainBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set brand
     *
     * @param  \App\MainBundle\Entity\Brand $brand
     * @return Product
     */
    public function setBrand(\App\MainBundle\Entity\Brand $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \App\MainBundle\Entity\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set descriptionFormatter
     *
     * @param  string  $descriptionFormatter
     * @return Product
     */
    public function setDescriptionFormatter($descriptionFormatter)
    {
        $this->descriptionFormatter = $descriptionFormatter;

        return $this;
    }

    /**
     * Get descriptionFormatter
     *
     * @return string
     */
    public function getDescriptionFormatter()
    {
        return $this->descriptionFormatter;
    }

    /**
     * Set descriptionTitle
     *
     * @param  string  $descriptionTitle
     * @return Product
     */
    public function setDescriptionTitle($descriptionTitle)
    {
        $this->descriptionTitle = $descriptionTitle;

        return $this;
    }

    /**
     * Get descriptionTitle
     *
     * @return string
     */
    public function getDescriptionTitle()
    {
        return $this->descriptionTitle;
    }

    /**
     * Add productProperties
     *
     * @param  \App\MainBundle\Entity\ProductProperty $productProperties
     * @return Product
     */
    public function addProductPropertie(\App\MainBundle\Entity\ProductProperty $productProperties)
    {
        $this->productProperties[] = $productProperties;

        return $this;
    }

    /**
     * Remove productProperties
     *
     * @param \App\MainBundle\Entity\ProductProperty $productProperties
     */
    public function removeProductPropertie(\App\MainBundle\Entity\ProductProperty $productProperties)
    {
        $this->productProperties->removeElement($productProperties);
    }

    /**
     * Get productProperties
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductProperties()
    {
        return $this->productProperties;
    }
}
