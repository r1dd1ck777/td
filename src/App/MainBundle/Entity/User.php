<?php

namespace App\MainBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Order", mappedBy="user", orphanRemoval=true)
     */
    protected $orders;

    /**
     * @ORM\OneToMany(targetEntity="Mention", mappedBy="user", orphanRemoval=true)
     */
    protected $mentions;

    public function __construct()
    {
        parent::__construct();
    }

//    /**
//     * @ORM\Column(type="string", length=255)
//     */
//    protected $firstname;
//
//    /**
//     * @ORM\Column(type="string", length=255)
//     */
//    protected $lastname;
//
//    /**
//     * Get the full name of the user (first + last name)
//     * @return string
//     */
//    public function getFullName()
//    {
//        return $this->getFirstname() . ' ' . $this->getLastname();
//    }

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
     * Set firstname
     *
     * @param  string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param  string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Add orders
     *
     * @param \App\MainBundle\Entity\Order $orders
     * @return User
     */
    public function addOrder(\App\MainBundle\Entity\Order $orders)
    {
        $this->orders[] = $orders;

        return $this;
    }

    /**
     * Remove orders
     *
     * @param \App\MainBundle\Entity\Order $orders
     */
    public function removeOrder(\App\MainBundle\Entity\Order $orders)
    {
        $this->orders->removeElement($orders);
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * Add mentions
     *
     * @param \App\MainBundle\Entity\Mention $mentions
     * @return User
     */
    public function addMention(\App\MainBundle\Entity\Mention $mentions)
    {
        $this->mentions[] = $mentions;

        return $this;
    }

    /**
     * Remove mentions
     *
     * @param \App\MainBundle\Entity\Mention $mentions
     */
    public function removeMention(\App\MainBundle\Entity\Mention $mentions)
    {
        $this->mentions->removeElement($mentions);
    }

    /**
     * Get mentions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMentions()
    {
        return $this->mentions;
    }
}
