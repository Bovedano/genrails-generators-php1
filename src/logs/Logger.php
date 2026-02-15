<?php

namespace App\logs;

use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\JsonFormatter;
use Monolog\Level;

class Logger
{
    // channel => level mínimo
    private const CHANNELS = [
        'debug'      => Level::Debug,
        'app'        => Level::Info,
        'error'      => Level::Error,
        'monitoring' => Level::Info,
        'request'    => Level::Info,
        'sql'        => Level::Debug,
    ];

    private static array $instances = [];

    public static function channel(string $name): MonologLogger
    {
        if (!isset(self::$instances[$name])) {
            self::$instances[$name] = self::create($name);
        }

        return self::$instances[$name];
    }

    private static function create(string $name): MonologLogger
    {
        $logger = new MonologLogger($name);

        $level = self::CHANNELS[$name] ?? Level::fromName($_ENV['LOG_LEVEL']);

        $dir = BASE_PATH . '/' . $_ENV['LOG_DIR'] . '/' . date('Y-m-d');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $handler = new StreamHandler("$dir/$name.log", $level);
        $handler->setFormatter(new JsonFormatter());

        $logger->pushHandler($handler);

        return $logger;
    }
}
