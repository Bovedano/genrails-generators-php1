<?php

namespace App\core;

use App\middleware\AuthMiddleware;
use App\middleware\RequestLogMiddleware;
use FastRoute\Dispatcher;
use Illuminate\Container\Container;

class RequestDispatcher
{
    public static function dispatch(Dispatcher $dispatcher, Container $container): void
    {
        // Extract HTTP method and URI from the request
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // Strip query string from URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        // Start request logging (captures timestamp, method and IP)
        $context = RequestLogMiddleware::start();

        // Match the URI against registered routes
        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            // No route matched the URI
            case Dispatcher::NOT_FOUND:
                http_response_code(404);
                echo json_encode(['error' => 'Not found']);
                break;

            // Route exists but HTTP method is not allowed
            case Dispatcher::METHOD_NOT_ALLOWED:
                http_response_code(405);
                echo json_encode(['error' => 'Method not allowed']);
                break;

            // Route matched: extract controller, method and params, then dispatch through auth middleware
            case Dispatcher::FOUND:
                [$class, $method] = explode('@', $routeInfo[1]);
                $params = $routeInfo[2];
                AuthMiddleware::handle($uri, $container, $class, $method, $params, $context);
                break;
        }

        // End request logging (calculates duration and writes to request.log)
        RequestLogMiddleware::end($uri, $context);
    }
}
