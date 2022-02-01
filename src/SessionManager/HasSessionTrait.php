<?php

declare(strict_types=1);

namespace Bytic\Session\SessionManager;

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

    /**
     * @return Session|SessionInterface|null
     */
    public function getSession()
    {
        if (null === $this->session) {
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
