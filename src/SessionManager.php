<?php

declare(strict_types=1);

namespace Bytic\Session;

/**
 * Class SessionManager.
 */
class SessionManager
{
    use SessionManager\HasSessionTrait;
    use SessionManager\HasStorageTrait;

    public function init()
    {
        $id = $this->checkRequestId();
        $this->start($id);
    }

//    /**
//     * Gets the session ID from REQUEST
//     * @return int
//     */
//    public function checkRequestId()
//    {
//        if (isset($_REQUEST['session_id'])) {
//            return $_REQUEST['session_id'];
//        }
//
//        return false;
//    }

    /**
     * @deprecated
     */
    public function reinitialize($id = false)
    {
//        $this->getSession()->save();
    }

    /**
     * Public method to return the session id.
     */
    public function getId(): string
    {
        return $this->getSession()->getId();
    }

    /**
     * @param int $lifetime
     *
     * @return $this
     */
    public function setLifetime($lifetime)
    {
        $this->getStorage()->setOptions(['cookie_lifetime' => $lifetime]);

        return $this;
    }

    /**
     * @param $domain
     */
    public function setRootDomain($domain)
    {
        if ('localhost' !== $domain) {
            ini_set('session.cookie_domain', '.' . $domain);
        }
        $this->getStorage()->setOptions(['cookie_domain' => $domain]);
    }

    /**
     * @deprecated
     */
    public function isAutoStart()
    {
        return ini_get('session.auto_start') && ('on' == strtolower(ini_get('session.auto_start')));
    }
}
