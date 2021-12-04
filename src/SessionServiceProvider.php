<?php

namespace Nip\Session;

use Nip\Container\ServiceProviders\Providers\AbstractSignatureServiceProvider;
use Nip\Session\Middleware\StartSession;

/**
 * Class MailServiceProvider
 * @package Nip\Mail
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
