<?php

namespace Createlinux\OAuth;

use Createlinux\OAuth\Client;

class UserAuth
{
    protected static $user = null;

    public static function getUser($accessToken)
    {
        if (!self::$user) {
            $oauthClient = create_litchi_oauth_client(get_litchi_auth_server_app_url(), get_litchi_auth_client_app_url());

            if ($accessToken) {
                $res = $oauthClient->getUserByAccessToken($accessToken);
                if ($res->isSuccess()) {
                    UserAuth::setUser($res->getUser());
                }
            }
        }
        return self::$user;
    }

    public static function getUserId()
    {
        if (!isset(self::$user['id'])) {
            return null;
        }
        return self::$user['id'];
    }

    /**
     * @param null $user
     */
    public static function setUser($user): void
    {
        self::$user = $user;
    }
}
