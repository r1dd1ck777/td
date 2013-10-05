<?php

namespace App\MainBundle\Controller;

use App\MainBundle\Entity\Cart;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;

class BaseCardController extends ResourceController
{
    /** @return \App\MainBundle\Entity\Cart */
    protected function getCurrentCart()
    {
        return $this->get('app.main.services.cart_manager')->getCurrentCart();
    }

    protected function setSessionCart(Cart $cart)
    {
        $this->get('app.main.services.cart_manager')->setSessionCart($cart);
    }
}
