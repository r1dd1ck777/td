<?php

namespace App\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="cart_order")
 * @ORM\Entity
 */
class Order
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
     * @ORM\ManyToOne(targetEntity="Cart")
     * @ORM\JoinColumn(name="cart_id", nullable=false)
     */
    protected $cart;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", nullable=true)
     */
    protected $user;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $fio;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $town;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $address;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $phone;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $email;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $paymentType;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $comments;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $deliveryType;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     */
    protected $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
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
     * Set fio
     *
     * @param string $fio
     * @return Order
     */
    public function setFio($fio)
    {
        $this->fio = $fio;

        return $this;
    }

    /**
     * Get fio
     *
     * @return string 
     */
    public function getFio()
    {
        return $this->fio;
    }

    /**
     * Set town
     *
     * @param string $town
     * @return Order
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string 
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Order
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Order
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Order
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set paymentType
     *
     * @param string $paymentType
     * @return Order
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    /**
     * Get paymentType
     *
     * @return string 
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * Set comments
     *
     * @param string $comments
     * @return Order
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set deliveryType
     *
     * @param string $deliveryType
     * @return Order
     */
    public function setDeliveryType($deliveryType)
    {
        $this->deliveryType = $deliveryType;

        return $this;
    }

    /**
     * Get deliveryType
     *
     * @return string 
     */
    public function getDeliveryType()
    {
        return $this->deliveryType;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Order
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set cart
     *
     * @param \App\MainBundle\Entity\Cart $cart
     * @return Order
     */
    public function setCart(\App\MainBundle\Entity\Cart $cart)
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * Get cart
     *
     * @return \App\MainBundle\Entity\Cart 
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Set user
     *
     * @param \App\MainBundle\Entity\User $user
     * @return Order
     */
    public function setUser(\App\MainBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \App\MainBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
