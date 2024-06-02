<?php

namespace Createlinux\OAuth;

use Illuminate\Support\Facades\Http;

final class Client
{

    /**
     * 认证服务器认证链接
     * @var string
     */
    protected string $openAuthClientURI = 'https://accounts.lizhiruanjian.com';
    protected string $openAuthServerURI = 'https://accounts-api.litchilab.com';
    protected string $redirectURI = '';
    protected string $clientId = '';
    protected string $score = '';
    protected string $state = '';
    protected string $code = '';

    public function __construct()
    {

    }

    /**
     * @param string $redirectURI 重定向URI
     * @return void
     */
    public function setRedirectURI(string $redirectURI)
    {
        $this->redirectURI = $redirectURI;
    }

    /**
     * @param string $clientId 客户端ID
     * @return void
     */
    public function setClientId(string $clientId)
    {
        $this->clientId = $clientId;
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
     * 开发环境下设置认证服务器客户端链接
     * @param string $oauthURI
     * @return void
     */
    public function setOpenAuthClientURIForDev(string $oauthURI)
    {
        //
        $this->openAuthClientURI = $oauthURI;
    }

    /**
     * 开发环境下设置认证服务器服务器端链接
     * @param string $oauthURI
     * @return void
     */
    public function setOpenAuthServerURIForDev(string $oauthURI)
    {
        $this->openAuthServerURI = $oauthURI;
    }

    /**
     * 获取授权码URI
     * @return string
     */
    public function generateAuthCodeURI()
    {
        $queryParams = http_build_query([
            "redirect_uri" => urlencode($this->redirectURI),
            "client_id" => $this->clientId,
            "response_type" => "code",
            "scope" => $this->score,
            "state" => $this->state
        ]);
        return $this->openAuthClientURI . "?" . $queryParams;
    }

    /**
     * @return string
     */
    public function generateAuthTokenURI()
    {
        return ltrim($this->openAuthServerURI, "/") . "/api/v1/open_auth_tokens";
    }

    /**
     * 生成需要传递的数据数组
     * @param string $code
     * @return array
     */
    public function generateAuthTokenData(string $code)
    {
        return [
            'client_id' => $this->clientId,
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => urlencode($this->redirectURI)
        ];
    }

    /**
     * 退出登录，删除访问令牌
     * @return
     */
    public function removeAccessToken(string $accessToken)
    {
        return Http::delete($this->openAuthServerURI."/api/v1/open_auth_tokens/{$accessToken}");
    }

    public function createNewAuthToken()
    {
        return Http::post($this->openAuthServerURI,$this->generateAuthTokenData($this->getCode()));
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }
}