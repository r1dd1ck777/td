<?php

namespace App\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Rid\Bundle\ImageBundle\Model\RidImage;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Category
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
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="childs")
     * @ORM\JoinColumn(name="parent_id", nullable=true)
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent", cascade={"persist", "detach"})
     */
    private $childs;

    /**
     * @ORM\ManyToMany(targetEntity="Brand", mappedBy="categories", cascade={"detach"})
     */
    private $brands;

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category", cascade={"detach"})
     */
    private $products;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="page", type="string", length=255, nullable=true)
     */
    private $page;

    /**
     * @ORM\Column(type="rid_image", length=255, options={"default" = ""})
     */
    private $image;

    public function setImage(RidImage $image)
    {
        $this->image = $image;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function __toString()
    {
        return (string) $this->getName();
    }

    public function __construct()
    {
        $this->image = new RidImage();
        $this->childs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->brands = new \Doctrine\Common\Collections\ArrayCollection();
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param  string   $name
     * @return Category
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
     * Set page
     *
     * @param  string   $page
     * @return Category
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return string
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set parent
     *
     * @param  \App\MainBundle\Entity\Category $parent
     * @return Category
     */
    public function setParent(\App\MainBundle\Entity\Category $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \App\MainBundle\Entity\Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add childs
     *
     * @param  \App\MainBundle\Entity\Category $childs
     * @return Category
     */
    public function addChild(\App\MainBundle\Entity\Category $childs)
    {
        $this->childs[] = $childs;

        return $this;
    }

    /**
     * Remove childs
     *
     * @param \App\MainBundle\Entity\Category $childs
     */
    public function removeChild(\App\MainBundle\Entity\Category $childs)
    {
        $this->childs->removeElement($childs);
    }

    /**
     * Get childs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChilds()
    {
        return $this->childs;
    }

    /**
     * Add brands
     *
     * @param  \App\MainBundle\Entity\Category $brands
     * @return Category
     */
    public function addBrand(\App\MainBundle\Entity\Category $brands)
    {
        $this->brands[] = $brands;

        return $this;
    }

    /**
     * Remove brands
     *
     * @param \App\MainBundle\Entity\Category $brands
     */
    public function removeBrand(\App\MainBundle\Entity\Category $brands)
    {
        $this->brands->removeElement($brands);
    }

    /**
     * Get brands
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBrands()
    {
        return $this->brands;
    }

    /**
     * Add products
     *
     * @param  \App\MainBundle\Entity\Product $products
     * @return Category
     */
    public function addProduct(\App\MainBundle\Entity\Product $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \App\MainBundle\Entity\Product $products
     */
    public function removeProduct(\App\MainBundle\Entity\Product $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }
}
