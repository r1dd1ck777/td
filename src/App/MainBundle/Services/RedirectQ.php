<?php

namespace App\MainBundle\Services;

use Symfony\Component\HttpFoundation\Request;

class RedirectQ
{
    const SESSION_REDIRECT_Q = 'app.redirect_q';
    protected $session;

    /**
     * @param mixed $session
     */
    public function setSession($session)
    {
        $this->session = $session;
    }

    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }

    public function set($url)
    {
        $this->session->set(self::SESSION_REDIRECT_Q, $url);
    }

    public function get($url = '/')
    {
        $url = $this->session->get(self::SESSION_REDIRECT_Q, $url);
        $this->clear();

        return $url;
    }

    public function clear()
    {
        $this->session->remove(self::SESSION_REDIRECT_Q);
    }
}
