<?php

namespace Bytic\Session;

use Bytic\Container\ServiceProviders\Providers\AbstractSignatureServiceProvider;
use Bytic\Session\Middleware\StartSession;

/**
 * Class MailServiceProvider
 * @package Bytic\Mail
 */
class SessionServiceProvider extends AbstractSignatureServiceProvider
{
    public const SERVICE_START = 'session';

    /**
     * @inheritdoc
     */
    public function register()
    {
        $this->registerSessionManager();
        $this->getContainer()->share(StartSession::class);
    }

    /**
     * Register the session manager instance.
     *
     * @return void
     */
    protected function registerSessionManager()
    {
        $this->getContainer()->share(self::SERVICE_START, SessionManager::class);
    }

    /**
     * @inheritdoc
     */
    public function provides(): array
    {
        return [self::SERVICE_START];
    }
}
