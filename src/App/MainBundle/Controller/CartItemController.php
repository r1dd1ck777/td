<?php

namespace App\MainBundle\Controller;

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

    public function deleteAction()
    {
        $resource = $this->findOr404();

        if ($this->getCurrentCart()->getItemById($resource->getId()) === $resource) {
            $this->delete($resource);
            $this->setFlash('success', 'delete');
        }

        return $this->redirectToIndex($resource);
    }
}
