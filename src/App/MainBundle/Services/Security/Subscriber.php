<?php

namespace App\MainBundle\Services\Security;

use App\MainBundle\Services\RedirectQ;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Listener responsible to change the redirection at the end of the password resetting
 */
class Subscriber implements EventSubscriberInterface
{
    /** @var  \App\MainBundle\Services\RedirectQ */
    protected $redirectQ;

    public function setRedirectQ(RedirectQ $redirectQ)
    {
        $this->redirectQ = $redirectQ;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
        );
    }

    public function onRegistrationSuccess(FormEvent $event)
    {
        $url = $this->redirectQ->get(null);
        if($url){
            $event->setResponse(new RedirectResponse($url));
        }
    }
}