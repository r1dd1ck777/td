<?php

namespace App\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table()
 * @ORM\Entity
 */
class Cart
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
     * @ORM\ManyToMany(targetEntity="CartItem", inversedBy="carts", cascade={"all"})
     * @ORM\JoinTable(name="cart_to_cart_item",
     *      joinColumns={@ORM\JoinColumn(name="cart_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="cart_item_id", referencedColumnName="id")}
     * )
     */
    protected $items;

    public function getItemById($id)
    {
        foreach ($this->getItems() as $item) {
            if ($item->getId() === (int) $id) {
                return $item;
            }
        }

        return null;
    }

    public function getCount()
    {
        $count = $this->getItems()->count();

        return $count > 0 ? "({$count})" : '';
    }

    public function getTotal()
    {
        return array_sum(array_map(function($p){return $p->getPrice();}, $this->getItems()->toArray()));
    }
    //--
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Add items
     *
     * @param  \App\MainBundle\Entity\CartItem $items
     * @return Cart
     */
    public function addItem(\App\MainBundle\Entity\CartItem $items)
    {
        $this->items[] = $items;

        return $this;
    }

    /**
     * Remove items
     *
     * @param \App\MainBundle\Entity\CartItem $items
     */
    public function removeItem(\App\MainBundle\Entity\CartItem $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItems()
    {
        return $this->items;
    }
}
