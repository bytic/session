<?php

declare(strict_types=1);

namespace Bytic\Session;

use Bytic\Session\Middleware\StartSession;
use Bytic\Container\ServiceProviders\Providers\AbstractSignatureServiceProvider;

/**
 * Class MailServiceProvider.
 */
class SessionServiceProvider extends AbstractSignatureServiceProvider
{
    public const SESSION_SERVICE = 'session';

    /**
     * {@inheritdoc}
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
        $this->getContainer()->share(self::SESSION_SERVICE, SessionManager::class);
    }

    /**
     * {@inheritdoc}
     */
    public function provides(): array
    {
        return [self::SESSION_SERVICE];
    }
}
