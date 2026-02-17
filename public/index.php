<?php

define('BASE_PATH', dirname(__DIR__));

require BASE_PATH . '/vendor/autoload.php';

use App\db\Connection;
use App\core\request\RequestDispatcher;
use App\logs\Logger;
use FastRoute\RouteCollector;

Connection::initialize();

// Dependencies container
$container = require BASE_PATH . '/src/core/bootstrap.php';

// Load routes
$dispatcher = FastRoute\simpleDispatcher(function(RouteCollector $r) {
    require __DIR__ . '/../src/apis/routes.php';
});

// Dispatch the incoming request, catch any unhandled exception
try {
    RequestDispatcher::dispatch($dispatcher, $container);
} catch (\Throwable $e) {
    $errorId = uniqid('err_');

    Logger::channel('error')->error("[$errorId] {$e->getMessage()}", [
        'file'  => $e->getFile(),
        'line'  => $e->getLine(),
        'trace' => $e->getTraceAsString(),
    ]);

    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Internal server error', 'error_id' => $errorId]);
}
