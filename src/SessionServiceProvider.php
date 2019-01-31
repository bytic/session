<?php

namespace Nip\Session;

use Nip\Container\ServiceProvider\AbstractSignatureServiceProvider;

/**
 * Class SessionServiceProvider
 * @package Nip\Session
 */
class SessionServiceProvider extends AbstractSignatureServiceProvider
{

    /**
     * @inheritdoc
     */
    public function register()
    {
        $this->registerLocale();
    }

    protected function registerLocale()
    {
//        $this->getContainer()->singleton('session', Locale::class);
    }

    /**
     * @inheritdoc
     */
    public function provides()
    {
        return ['session'];
    }
}
