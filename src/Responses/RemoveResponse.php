<?php

namespace Createlinux\OAuth\Responses;

class RemoveResponse
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
        return $this->body['message'];
    }

    public function getContext(): array|null|string
    {
        return $this->body['context'];
    }
}