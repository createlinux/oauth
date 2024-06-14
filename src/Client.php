<?php

namespace Createlinux\OAuth;

use Createlinux\OAuth\Responses\CreateTokenResponse;
use Createlinux\OAuth\Responses\GetUserResponse;
use Createlinux\OAuth\Responses\RemoveResponse;

final class Client
{

    /**
     * 认证服务器认证链接
     * @var string
     */
    protected string $score = '';
    protected string $state = '';
    private string $accessToken;

    public function __construct()
    {
        $this->accessToken = get_litchi_access_token();
    }

    /**
     * @param string $score 域
     * @return void
     */
    public function setScore(string $score = 'userinfo')
    {
        $this->score = $score;
    }

    /**
     * @param string $state 表示客户端的当前状态，可以指定任意值，认证服务器会原封不动地返回这个值。
     * @return void
     */
    public function setState(string $state)
    {
        $this->state = $state;
    }

    /**
     * 获取授权码URI
     * @return string
     */
    public function generateAuthCodeURI()
    {
        $queryParams = http_build_query([
            "redirect_uri" => urlencode(get_litchi_auth_client_redirect_uri()),
            "client_id" => get_litchi_auth_client_id(),
            "response_type" => "code",
            "scope" => $this->getScore(),
            "state" => $this->getState()
        ]);
        return get_litchi_auth_center_client_uri() . "?" . $queryParams;
    }

    /**
     * @return string
     */
    public function generateAuthTokenURI()
    {
        return ltrim(get_litchi_auth_center_server_uri(), "/") . "/api/v1/open_auth_tokens";
    }

    /**
     * 退出登录，删除访问令牌
     * @return
     */
    public function removeAccessToken(string $accessToken): RemoveResponse
    {
        $response = Http::delete(get_litchi_auth_center_server_uri() . "/api/v1/open_auth_tokens/{$accessToken}", $accessToken);
        return new RemoveResponse($response);
    }

    /**
     *
     * 创建token
     * @return CreateTokenResponse
     */
    public function createNewAuthToken(string $code): CreateTokenResponse
    {
        $response = Http::post(get_litchi_auth_center_server_uri() . "/api/v1/open_auth_tokens", [
            'client_id' => get_litchi_auth_client_id(),
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => urlencode(get_litchi_auth_client_redirect_uri()),
            'secret' => get_litchi_auth_client_secret()
        ]);
        return new CreateTokenResponse($response);
    }

    /**
     * 返回token信息和用户信息
     * @return bool|string
     */
    public function getUserByAccessToken(string $accessToken = ''): GetUserResponse
    {
        $accessToken = $accessToken ?: $this->getAccessToken();
        $response = Http::get(get_litchi_auth_center_server_uri() . "/api/v1/open_auth_tokens/" . $accessToken, [
            'Authorization: Bearer ' . $accessToken
        ]);
        return new GetUserResponse($response);
    }

    public function getScore(): string
    {
        return $this->score;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }


}