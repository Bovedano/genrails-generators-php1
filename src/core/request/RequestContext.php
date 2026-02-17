<?php

namespace App\core\request;

use Illuminate\Container\Container;

class RequestContext
{
    private string $class;
    private string $method;
    private string $httpMethod;
    private string $uri;
    private string $ip;
    private ?string $origin;
    private ?string $userAgent;
    private ?string $contentType;
    private Container $container;

    public function __construct(string $class, string $method, Container $container)
    {
        $this->class = $class;
        $this->method = $method;
        $this->container = $container;
        $this->httpMethod = $_SERVER['REQUEST_METHOD'];
        $this->ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $this->origin = $_SERVER['HTTP_ORIGIN'] ?? null;
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $this->contentType = $_SERVER['CONTENT_TYPE'] ?? null;

        $uri = $_SERVER['REQUEST_URI'];
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $this->uri = $uri;
    }

    public function getContainer(): Container
    {
        return $this->container;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getHttpMethod(): string
    {
        return $this->httpMethod;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    public function getContentType(): ?string
    {
        return $this->contentType;
    }
}
