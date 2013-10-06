<?php

namespace App\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity
 */
class CartItem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Product", cascade={"detach", "persist"})
     * @ORM\JoinColumn(name="product_id", nullable=false)
     */
    protected $product;

    /**
     * @ORM\ManyToMany(targetEntity="Cart", mappedBy="items", cascade={"detach"})
     */
    protected $carts;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $quantity=1;

    public function getPrice()
    {
        return $this->getProduct()->getPrice() * $this->getQuantity();
    }

    /**
     * Set quantity
     *
     * @param  integer  $quantity
     * @return CartItem
     */
    public function setQuantity($quantity)
    {
        if (is_numeric($quantity) && $quantity > 1) {
            $this->quantity = $quantity;
        }

        return $this;
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
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set product
     *
     * @param  \App\MainBundle\Entity\Product $product
     * @return CartItem
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->carts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add carts
     *
     * @param  \App\MainBundle\Entity\Cart $carts
     * @return CartItem
     */
    public function addCart(\App\MainBundle\Entity\Cart $carts)
    {
        $this->carts[] = $carts;

        return $this;
    }

    /**
     * Remove carts
     *
     * @param \App\MainBundle\Entity\Cart $carts
     */
    public function removeCart(\App\MainBundle\Entity\Cart $carts)
    {
        $this->carts->removeElement($carts);
    }

    /**
     * Get carts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCarts()
    {
        return $this->carts;
    }
}
