<?php

namespace App\core\request;

class Request
{
    private array $pathParams;
    private array $queryParams;
    private ?array $body;
    private RequestContext $context;

    public function __construct(array $pathParams, array $queryParams, ?array $body, RequestContext $context)
    {
        $this->pathParams = $pathParams;
        $this->queryParams = $queryParams;
        $this->body = $body;
        $this->context = $context;
    }

    public function getContext(): RequestContext
    {
        return $this->context;
    }

    public function setContext(RequestContext $context): void
    {
        $this->context = $context;
    }

    public function hasQueryParams(): bool
    {
        return count($this->queryParams) > 0;
    }

    public function hasPathParams(): bool
    {
        return count($this->pathParams) > 0;
    }

    public function hasBody(): bool
    {
        return $this->body !== null;
    }

    public function hasQueryParam(string $key): bool
    {
        return array_key_exists($key, $this->queryParams);
    }

    public function hasPathParam(string $key): bool
    {
        return array_key_exists($key, $this->pathParams);
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function getPathParams(): array
    {
        return $this->pathParams;
    }

    public function getBody(): ?array
    {
        return $this->body;
    }

    public function getQueryParam(string $key): mixed
    {
        return $this->queryParams[$key] ?? null;
    }

    public function getPathParam(string $key): mixed
    {
        return $this->pathParams[$key] ?? null;
    }
}
