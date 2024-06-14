<?php

namespace Createlinux\OAuth;

use Createlinux\OAuth\Client;

class UserAuth
{
    protected static $user = null;

    public static function getUser()
    {
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
