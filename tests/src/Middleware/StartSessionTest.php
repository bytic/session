<?php

namespace Nip\Session\Tests\src\Middleware;

use Nip\Http\Request;
use Nip\Http\Response\Response;
use Nip\Http\ServerMiddleware\Dispatcher;
use Nip\Session\Middleware\StartSession;
use Nip\Session\SessionManager;
use Nip\Session\Tests\src\AbstractTest;

/**
 * Class DebugbarMiddlewareTest
 * @package Nip\DebugBar\Tests\Middleware
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
