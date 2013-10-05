<?php

namespace App\MainBundle\Twig;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

class AppExtension extends \Twig_Extension
{
    protected $cartManager;

    /**
     * @param mixed $artManager
     */
    public function setCartManager($cartManager)
    {
        $this->cartManager = $cartManager;
    }

    public function getFunctions()
    {
        return array(
            'get_current_cart' => new \Twig_SimpleFunction('get_class', array( $this, 'getCurrentCart') ),
        );
    }

    public function getCurrentCart()
    {
        return $this->cartManager->getCurrentCart();
    }

    public function getName()
    {
        return 'app_extension';
    }
}