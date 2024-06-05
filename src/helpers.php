<?php

use \Createlinux\OAuth\Client;

if (!function_exists('get_litchi_auth_client_key')) {
    function get_litchi_auth_client_key()
    {
        return 'LITCHI_AUTH_CLIENT_ID';
    }
}
if (!function_exists('get_litchi_auth_client_app_url')) {
    function get_litchi_auth_client_app_url()
    {
        return "LITCHI_AUTH_CLIENT_APP_URL";
    }
}
if (!function_exists('get_litchi_auth_server_app_url')) {
    function get_litchi_auth_server_app_url()
    {
        return "LITCHI_AUTH_SERVER_APP_URL";
    }
}
if (!function_exists('create_litchi_oauth_client')) {
    function create_litchi_oauth_client($AUTH_SERVER_APP_URL = '', $AUTH_CLIENT_APP_URL = '')
    {
        $oauthClient = new \Createlinux\OAuth\Client();
        $oauthClient->setClientId(getenv(get_litchi_auth_client_key()));
        if ($AUTH_CLIENT_APP_URL) {
            $oauthClient->setOpenAuthClientURIForDev(getenv(get_litchi_auth_client_app_url()));
        }
        if ($AUTH_SERVER_APP_URL) {
            $oauthClient->setOpenAuthServerURIForDev(getenv(get_litchi_auth_server_app_url()));
        }
        return $oauthClient;
    }
}