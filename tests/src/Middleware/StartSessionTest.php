<?php

declare(strict_types=1);

namespace Bytic\Session\Tests\Middleware;

use Bytic\Session\Middleware\StartSession;
use Bytic\Session\SessionManager;
use Bytic\Session\Tests\AbstractTest;
use Nip\Http\Request;
use Nip\Http\Response\Response;
use Nip\Http\ServerMiddleware\Dispatcher;

/**
 * Class DebugbarMiddlewareTest
 * @package Bytic\DebugBar\Tests\Middleware
 */
class StartSessionTest extends AbstractTest
{
    public function testProcess()
    {
        $manager = new SessionManager();

        $dispatcher = new Dispatcher(
            [
                new StartSession($manager),
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
