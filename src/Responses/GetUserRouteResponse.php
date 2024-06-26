<?php

namespace Createlinux\OAuth\Responses;

class GetUserRouteResponse
{
    /**
     * @var mixed
     */
    private array $body;

    public function __construct(string $response)
    {
        $this->body = json_decode($response, true);
    }

    public function isSuccess(): bool
    {
        return $this->body['code'] === 200;
    }

    public function getMessage(): string
    {
        return $this->body['message'] ?? '';
    }

    public function getContext(): array|string|null
    {
        return $this->body['context'];
    }

    public function getAll(): array
    {
        return $this->getContext()['items'] ?? [];
    }

    public function hasAccessPermission(string $routeHash): bool
    {
        return in_array($routeHash,array_column($this->getAll(),'routeHash'));
    }
}