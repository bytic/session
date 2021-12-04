<?php

namespace Bytic\Session\Tests\Middleware;

use Bytic\Session\Middleware\StartSession;
use Bytic\Session\SessionManager;
use Bytic\Session\Tests\AbstractTest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DebugbarMiddlewareTest
 * @package Bytic\DebugBar\Tests\Middleware
 */
class StartSessionTest extends AbstractTest
{
    public function testProcess()
    {
        $sessionManager = new SessionManager();

        $dispatcher = new Dispatcher(
            [
                new StartSession($sessionManager),
                function () {
                    $response = new Response();
                    $response->setContent('Hello World');
                    return $response;
                },
            ]
        );

        /** @var Response $response */
        $response = $dispatcher->dispatch(new Request());

        self::assertInstanceOf(Response::class, $response);
    }
}
