<?php

namespace Createlinux\OAuth\Responses;

class GetUserResponse
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

    public function getUser(): ?array
    {
        return $this->getContext()['user'] ?? null;
    }

    public function getUserId(): ?string
    {
        return $this->getContext()['user']['id'] ?? null;
    }

    public function getUserMobile(): ?string
    {
        return $this->getContext()['user']['mobile'] ?? null;
    }

}