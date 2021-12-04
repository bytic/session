<?php

namespace Nip\Session\SessionManager;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 *
 */
trait HasSessionTrait
{

    /**
     * @var SessionInterface
     */
    protected $session = null;

    public function getSession()
    {
        if ($this->session === null) {
            $this->session = $this->create();
        }
        return $this->session;
    }

    public function setSession(SessionInterface $session)
    {
        $this->session = $session;
    }

    protected function create(): Session
    {
        return new Session(
            $this->getStorage()
        );
    }
}
