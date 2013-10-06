<?php

namespace App\MainBundle\Controller;

use App\MainBundle\Entity\Cart;
use Symfony\Component\HttpFoundation\Request;

class CartController extends BaseCardController
{
    public function listAction()
    {
        $cart = $this->getCurrentCart();

        return $this->render('AppMainBundle:Cart:list.html.twig', array(
            'cart' => $cart
        ));
    }

    public function saveAction()
    {
        $request = $this->getRequest();
        $cart = $this->getCurrentCart();
        $cartData = $request->get('cart');
        foreach ($cartData['items'] as $key => $itemData) {
            $cart->getItemById($key)->setQuantity($itemData['quantity']);
        }
        $this->persistAndFlush($cart);

        return $this->redirect($request->headers->get('referer'));
    }
}
