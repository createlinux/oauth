<?php

namespace Createlinux\OAuth;
class Client
{

    /**
     * 认证服务器认证链接
     * @var string
     */
    protected $oauthURI = 'https://accounts.litchilab.com';

    public function __construct()
    {

    }

    /**
     * 开发环境下设置认证服务器链接
     * @param string $oauthURI
     * @return void
     */
    public function setOauthURIForDev(string $oauthURI)
    {
        //
        $this->oauthURI = $oauthURI;
    }


    /**
     * 生成跳转链接
     * @param string $redirectURI 重定向URI
     * @param string $clientId 客户端ID
     * @param string $scope 域
     * @param string $state 表示客户端的当前状态，可以指定任意值，认证服务器会原封不动地返回这个值。
     * @return string
     */
    public function generateAuthURI(string $redirectURI, string $clientId, string $scope = "userinfo", string $state = "")
    {
        $queryParams = http_build_query([
            "redirect_uri" => urlencode($redirectURI),
            "client_id" => $clientId,
            "response_type" => "code",
            "scope" => $scope,
            "state" => $state
        ]);
        return $this->oauthURI . "?" . $queryParams;
    }


}