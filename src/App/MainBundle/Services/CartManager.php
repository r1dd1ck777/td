<?php

namespace App\MainBundle\Services;

use App\MainBundle\Entity\Cart;
use Doctrine\ORM\NoResultException;

class CartManager
{
    const CART_KEY = 'cart.id';
    protected $session;
    protected $repository;
    protected $em;

    /**
     * @param mixed $em
     */
    public function setEm($em)
    {
        $this->em = $em;
    }

    /**
     * @param mixed $repository
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param mixed $session
     */
    public function setSession($session)
    {
        $this->session = $session;
    }

    /** @return \App\MainBundle\Entity\Cart */
    public function getCurrentCart()
    {
        $id = $this->session->get(self::CART_KEY);
        $cart = null;
        if ($id) {
            try {
                $cart = $this->repository->findWithItems($id);
            } catch (NoResultException $e) {
            }
        }
        if (!$cart) {
            $cart = $this->repository->createNew();
            $this->em->persist($cart);
            $this->em->flush();
        }
        $this->setSessionCart($cart);

        return $cart;
    }

    public function setSessionCart(Cart $cart)
    {
        $this->session->set(self::CART_KEY, $cart->getId());
    }
}
