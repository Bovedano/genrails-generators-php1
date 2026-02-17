<?php

namespace App\middleware;

use App\core\request\Request;
use App\core\request\RequestContext;
use Illuminate\Container\Container;

class RequestMiddleware
{
    public static function handle(array $routeInfo, Container $container): Request
    {
        [$class, $method] = explode('@', $routeInfo[1]);
        $params = $routeInfo[2];
        $body = json_decode(file_get_contents('php://input'), true);
        $context = new RequestContext($class, $method, $container);

        return new Request($params, $_GET, $body, $context);
    }
}
