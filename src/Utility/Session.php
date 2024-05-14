<?php

declare(strict_types=1);

namespace Bytic\Session\Utility;

use Bytic\Session\SessionManager;
use Bytic\Session\SessionServiceProvider;
use Nip\Container\Utility\Container;

/**
 *
 */
class Session
{
    /**
     * @param $key
     * @param $default
     *
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        return static::session()->getSession()->get($key, $default);
    }

    /**
     * @return SessionManager|null
     */
    protected static function session()
    {
        /** @var SessionManager|null $session */
        static $session = null;
        if (null === $session) {
            $session = Container::container()
                ->get(SessionServiceProvider::SESSION_SERVICE);
        }

        return $session;
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public static function set(string $name, $value)
    {
        return static::session()->getSession()->get($name, $value);
    }
}
