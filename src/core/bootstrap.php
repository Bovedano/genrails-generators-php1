<?php

use Illuminate\Container\Container;
use App\apis\_config\migration\services\MigrationService;
use App\apis\_auth\services\JWTService;

$container = new Container();

$container->singleton(MigrationService::class, function () {
    return new MigrationService(BASE_PATH . '/src/db/migrations');
});

$container->singleton(JWTService::class, function () {
    return new JWTService(
        $_ENV['JWT_SECRET'],
        (int) $_ENV['JWT_EXPIRATION'],
        (int) $_ENV['JWT_REFRESH_EXPIRATION'],
    );
});

return $container;
