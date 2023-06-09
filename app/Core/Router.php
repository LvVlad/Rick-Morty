<?php declare(strict_types=1);

namespace App\Core;

use App\Controllers\Controller;
use FastRoute;

class Router
{
    public static function response(): ?View
    {
        $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/', ['App\Controllers\Controller', 'characterOfPage']);
            $r->addRoute('GET', '/characters[/{page}]', ['App\Controllers\Controller', 'characterOfPage']);
        });

        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                return null;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                return null;
            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                [$controllerName, $functionName] = $handler;
                $page = 20;

                $controller = new Controller;

                return $controller->$functionName($page);
        }
    }
}