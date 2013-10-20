<?php

namespace App\MainBundle\Services\Security;

use App\MainBundle\Services\RedirectQ;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class LoginHandler implements AuthenticationSuccessHandlerInterface
{
    /** @var  \App\MainBundle\Services\RedirectQ */
    protected $redirectQ;
    protected $routing;

    /**
     * @param mixed $routing
     */
    public function setRouting($routing)
    {
        $this->routing = $routing;
    }

    public function setRedirectQ(RedirectQ $redirectQ)
    {
        $this->redirectQ = $redirectQ;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $url = $this->redirectQ->get(null);

        return $url ? new RedirectResponse($url) : new RedirectResponse($this->routing->generate('app_main_homepage'));
    }
}