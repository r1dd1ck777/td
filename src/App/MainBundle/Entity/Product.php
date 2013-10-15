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
    const FORMATTER_RICHHTML = 'richhtml';

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
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $guaranty;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $info;

    /**
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(name="descriptionFormatter", type="string", length=50)
     */
    private $descriptionFormatter = self::FORMATTER_RICHHTML;

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
     * @ORM\JoinColumn(name="brand_id", nullable=true, onDelete="SET NULL")
     */
    private $brand;

    /**
     * @ORM\Column(type="rid_image", length=255, options={"default" = ""})
     */
    private $image;

    /**
     * @ORM\Column(type="rid_image", length=255, options={"default" = ""})
     */
    private $image2;

    /**
     * @ORM\Column(type="rid_image", length=255, options={"default" = ""})
     */
    private $image3;

    /**
     * @ORM\Column(type="rid_image", length=255, options={"default" = ""})
     */
    private $image4;

    /**
     * @ORM\OneToMany(targetEntity="ProductProperty", mappedBy="product", cascade={"persist", "remove"})
     */
    protected $productProperties;

    protected $selectedPrototype;

    /**
     * @return \App\MainBundle\Entity\Prototype
     */
    public function getSelectedPrototype()
    {
        return $this->selectedPrototype;
    }

    public function __construct()
    {
        $this->selectedPrototype = new  Prototype();
        $this->image = new RidImage();
        $this->image2 = new RidImage();
        $this->image3 = new RidImage();
        $this->image4 = new RidImage();
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

    /**
     * Set isPresent
     *
     * @param  boolean $isPresent
     * @return Product
     */
    public function setIsPresent($isPresent)
    {
        if (is_string($isPresent)) {
            if ($isPresent == 'Да') {$isPresent=true;} else {$isPresent=false;}
        }
        $this->isPresent = $isPresent;

        return $this;
    }

    public function mergeProperties(Prototype $prototype)
    {
        $this->selectedPrototype = $prototype;
        $properties = $prototype->getProperties();
        foreach ($properties as $property) {
            $pp = new ProductProperty();
            $pp->setProperty($property);
            $pp->setProduct($this);
            $this->addProductPropertie($pp);
        }
    }

    public function __toString()
    {
        return (string) $this->getName();
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

    /**
     * Add productProperties
     *
     * @param  \App\MainBundle\Entity\ProductProperty $productProperties
     * @return Product
     */
    public function addProductProperty(\App\MainBundle\Entity\ProductProperty $productProperties)
    {
        $this->productProperties[] = $productProperties;

        return $this;
    }

    /**
     * Remove productProperties
     *
     * @param \App\MainBundle\Entity\ProductProperty $productProperties
     */
    public function removeProductProperty(\App\MainBundle\Entity\ProductProperty $productProperties)
    {
        $this->productProperties->removeElement($productProperties);
    }

    /**
     * Set info
     *
     * @param  string  $info
     * @return Product
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set image2
     *
     * @param  rid_image $image2
     * @return Product
     */
    public function setImage2($image2)
    {
        $this->image2 = $image2;

        return $this;
    }

    /**
     * Get image2
     *
     * @return rid_image
     */
    public function getImage2()
    {
        return $this->image2;
    }

    /**
     * Set image3
     *
     * @param  rid_image $image3
     * @return Product
     */
    public function setImage3($image3)
    {
        $this->image3 = $image3;

        return $this;
    }

    /**
     * Get image3
     *
     * @return rid_image
     */
    public function getImage3()
    {
        return $this->image3;
    }

    /**
     * Set image4
     *
     * @param  rid_image $image4
     * @return Product
     */
    public function setImage4($image4)
    {
        $this->image4 = $image4;

        return $this;
    }

    /**
     * Get image4
     *
     * @return rid_image
     */
    public function getImage4()
    {
        return $this->image4;
    }

    /**
     * Set guaranty
     *
     * @param  integer $guaranty
     * @return Product
     */
    public function setGuaranty($guaranty)
    {
        $this->guaranty = $guaranty;

        return $this;
    }

    /**
     * Get guaranty
     *
     * @return integer
     */
    public function getGuaranty()
    {
        return $this->guaranty;
    }
}
