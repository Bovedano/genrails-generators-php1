<?php

namespace App\middleware;

use App\logs\Logger;

class RequestLogMiddleware
{
    public static function start(): object
    {
        return (object) [
            'time'   => microtime(true),
            'method' => $_SERVER['REQUEST_METHOD'],
            'ip'     => $_SERVER['REMOTE_ADDR'] ?? '-',
        ];
    }

    public static function end(string $uri, object $context): void
    {
        $ms = round((microtime(true) - $context->time) * 1000, 2);

        Logger::channel('request')->info("{$context->method} {$uri}", [
            'status'  => http_response_code(),
            'ms'      => $ms,
            'ip'      => $context->ip,
            'user_id' => $context->user_id ?? null,
        ]);
    }
}
