<?php

namespace App\MainBundle\Controller;

use App\MainBundle\Entity\Cart;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;

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

    protected function clearSessionCart()
    {
        $this->get('app.main.services.cart_manager')->clearSessionCart();
    }

    public function addFlash($type, $message)
    {
        $this->get('session')
            ->getFlashBag()
            ->add($type, $this->get('translator')->trans($message, array(), 'AppMainBundle'));
    }

    public function setRedirectQ($url)
    {
        $this->get('app.main.services.redirect_q')->set($url);
    }

    public function getRedirectQ($url = '/')
    {
        $this->get('app.main.services.redirect_q')->get($url);

        return $url;
    }

    public function clearRedirectQ()
    {
        $this->get('app.main.services.redirect_q')->clear();
    }

    /** @return \Symfony\Component\Security\Core\SecurityContext */
    public function getSecurityContext()
    {
        return $this->get('security.context');
    }
}
