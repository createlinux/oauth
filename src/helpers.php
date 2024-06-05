<?php

use \Createlinux\OAuth\Client;

if (function_exists('create_litchi_oauth_client')) {
    function create_litchi_oauth_client($AUTH_SERVER_APP_URL = '', $AUTH_CLIENT_APP_URL = '')
    {
        $oauthClient = new \Createlinux\OAuth\Client();
        $oauthClient->setClientId(getenv('LITCHI_AUTH_CLIENT_ID'));
        if ($AUTH_CLIENT_APP_URL) {
            $oauthClient->setOpenAuthClientURIForDev(getenv('LITCHI_AUTH_CLIENT_APP_URL'));
        }
        if ($AUTH_SERVER_APP_URL) {
            $oauthClient->setOpenAuthServerURIForDev(getenv('LITCHI_AUTH_SERVER_APP_URL'));
        }
        return $oauthClient;
    }
}