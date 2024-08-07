<?php

namespace Createlinux\OAuth\Responses;

class CreateTokenResponse
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
        return $this->body['code'] === '1-201';
    }

    public function getMessage(): string
    {
        return $this->body['message'] ?? '';
    }

    public function getContext(): array|string|null
    {
        return $this->body['context'];
    }

    /**
     *
     * access_token
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->getContext()['accessToken'] ?? '';
    }

    /**
     *
     * 刷新token
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->getContext()['refreshToken'] ?? '';
    }

    /**
     *
     * 有效秒数
     * @return int
     */
    public function getExpirationSeconds(): int
    {
        return $this->getContext()['expirationSeconds'] ?? 0;
    }

    /**
     *
     * 过期时间
     * @return string
     */
    public function getExpiredAt():string
    {
        return $this->getContext()['expiredAt'] ?? '';
    }
}