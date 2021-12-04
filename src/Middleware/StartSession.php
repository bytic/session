<?php

namespace Nip\Session\Middleware;

use Nip\Http\ServerMiddleware\Middlewares\ServerMiddlewareInterface;
use Nip\Session\SessionManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Class StartSession
 * @package Nip\Session\Middleware
 */
class StartSession implements ServerMiddlewareInterface
{

    /**
     * The session manager.
     *
     * @var SessionManager
     */
    protected $manager;

    /**
     * Indicates if the session was handled for the current request.
     *
     * @var bool
     */
    protected $sessionHandled = false;

    /**
     * Create a new session middleware.
     *
     * @param SessionManager $manager
     */
    public function __construct(SessionManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @inheritdoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($this->sessionHandled) {
            return $handler->handle($request);
        }

        $this->sessionHandled = true;
        $this->startSession($request);

        return $handler->handle($request);
    }

    /**
     * Start the session for the given request.
     *
     * @param ServerRequestInterface $request
     */
    protected function startSession(ServerRequestInterface $request)
    {
        $request->setSessionFactory(
            function () use ($request) {
                $session = $this->manager->getSession();
                if ($request->isCLI() == false) {
                    $requestHTTP = $request->getHttp();
                    $domain = $requestHTTP->getRootDomain();

//            if (!$sessionManager->isAutoStart()) {
//                $sessionManager->setRootDomain($domain);
////                $sessionManager->setLifetime(config('SESSION.lifetime'));
//            }
//
//            if ($domain != 'localhost') {
//                CookieJar::instance()->setDefaults(
//                    ['domain' => '.' . $domain]
//                );
//            }
//            $sessionManager->init();
                }
                if ($session && !$session->isStarted()) {
                    $sessionId = $request->cookies->get($session->getName(), '');
                    $session->setId($sessionId);
                }
                return $session;
            }
        );
    }

    /**
     * @return SessionManager
     */
    public function getManager(): SessionManager
    {
        return $this->manager;
    }
}
