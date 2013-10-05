<?php

namespace App\MainBundle\Controller;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;

class CartItemController extends BaseCardController
{
    public function addAction(Request $request)
    {
        $cart = $this->getCurrentCart();
        $product = $this->get('app.repository.product')->find($this->getRequest()->get('id'));
        $cartItem = $this->createNew();
        $cartItem->setProduct($product)->setQuantity(1);
        $cart->addItem($cartItem);
        $this->persistAndFlush($cart);

        return $this->redirect($this->getRequest()->headers->get('referer'));
    }
}
