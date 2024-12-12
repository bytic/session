<?php

declare(strict_types=1);

namespace Bytic\Session\Utility;

use Bytic\Session\SessionManager;
use Bytic\Session\SessionServiceProvider;
use Nip\Container\Utility\Container;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

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
        return static::session()->set($key, $default);
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public static function set(string $name, $value)
    {
        return static::session()->get($name, $value);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Session\Session|SessionInterface|null
     */
    public static function session()
    {
        return static::sessionManager()->getSession();
    }

    public static function sessionManager(): ?SessionManager
    {
        /** @var SessionManager|null $manager */
        static $manager = null;
        if (null === $manager) {
            $manager = self::sessionManagerGenerate();
        }
        return $manager;
    }

    /**
     * @return SessionManager|null
     */
    protected static function sessionManagerGenerate(): ?SessionManager
    {
        return Container::container()
            ->get(SessionServiceProvider::SESSION_SERVICE);
    }
}
