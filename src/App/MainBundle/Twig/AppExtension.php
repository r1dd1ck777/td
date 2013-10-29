<?php

namespace App\MainBundle\Twig;

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
            'get_current_cart' => new \Twig_SimpleFunction('get_current_cart', array( $this, 'getCurrentCart') ),
            'isBrandFilterEmpty' => new \Twig_SimpleFunction('isBrandFilterEmpty', array( $this, 'isBrandFilterEmpty') ),

        );
    }

    public function isBrandFilterEmpty($brands)
    {
        foreach($brands as $brand){
            if ($brand){return false;}
        }

        return true;
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
