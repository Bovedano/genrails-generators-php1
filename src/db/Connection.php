<?php

namespace App\db;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\logs\Logger;
use Dotenv\Dotenv;

class Connection
{
    private static bool $initialized = false;

    public static function initialize(): void
    {
        if (self::$initialized) return;

        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();

        $capsule = new Capsule;

        $capsule->addConnection([
            'driver'    => $_ENV['DB_DRIVER'],
            'host'      => $_ENV['DB_HOST'],
            'port'      => $_ENV['DB_PORT'],
            'database'  => $_ENV['DB_DATABASE'],
            'username'  => $_ENV['DB_USERNAME'],
            'password'  => $_ENV['DB_PASSWORD'],
            'charset'   => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix'    => '',
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        Capsule::connection()->enableQueryLog();
        Capsule::connection()->listen(function ($query) {
            Logger::channel('sql')->debug($query->sql, [
                'bindings' => $query->bindings,
                'ms'       => $query->time,
            ]);
        });

        self::$initialized = true;
    }
}