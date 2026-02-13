<?php

define('BASE_PATH', dirname(__DIR__));

require BASE_PATH . '/vendor/autoload.php';

use App\db\Connection;
use FastRoute\RouteCollector;

Connection::initialize();

// Contenedor de dependencias
$container = require BASE_PATH . '/src/bootstrap.php';

// Cargar rutas
$dispatcher = FastRoute\simpleDispatcher(function(RouteCollector $r) {
    require __DIR__ . '/../src/apis/routes.php';
});

// Despachar petición
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        echo json_encode(['error' => 'Not found']);
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;

    case FastRoute\Dispatcher::FOUND:
        [$class, $method] = explode('@', $routeInfo[1]);
        $params = $routeInfo[2];
        $container->make($class)->$method($params);
        break;
}