<?php

use Illuminate\Container\Container;
use App\apis\_config\migration\services\MigrationService;
use App\apis\_commons\services\jwt\JWTService;
use App\apis\_commons\services\mail\MailService;
use App\apis\_commons\services\templates\TemplateService;

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

$container->singleton(MailService::class, function () {
    return new MailService(
        $_ENV['MAIL_HOST'],
        (int) $_ENV['MAIL_PORT'],
        $_ENV['MAIL_USERNAME'],
        $_ENV['MAIL_PASSWORD'],
        $_ENV['MAIL_ENCRYPTION'],
        $_ENV['MAIL_FROM_ADDRESS'],
        $_ENV['MAIL_FROM_NAME'],
    );
});

$container->singleton(TemplateService::class, function () {
    return new TemplateService(BASE_PATH . '/src/apis/_commons/services/templates');
});

return $container;
