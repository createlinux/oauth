<?php

use \Createlinux\OAuth\Client;

const LITCHI_AUTH_CLIENT_ID_NAME = 'LITCHI_AUTH_CLIENT_ID';
const LITCHI_AUTH_CLIENT_APP_URL_NAME = 'LITCHI_AUTH_CLIENT_APP_URL';
const LITCHI_AUTH_SERVER_APP_URL_NAME = 'LITCHI_AUTH_SERVER_APP_URL';
if (!function_exists('get_litchi_auth_client_key')) {
    function get_litchi_auth_client_id()
    {
        return getenv(LITCHI_AUTH_CLIENT_ID_NAME);
    }
}
if (!function_exists('get_litchi_auth_client_app_url')) {
    function get_litchi_auth_client_app_url()
    {
        return getenv(LITCHI_AUTH_CLIENT_APP_URL_NAME);
    }
}
if (!function_exists('get_litchi_auth_server_app_url')) {
    function get_litchi_auth_server_app_url()
    {
        return getenv(LITCHI_AUTH_SERVER_APP_URL_NAME);
    }
}
if (!function_exists('create_litchi_oauth_client')) {
    function create_litchi_oauth_client($AUTH_SERVER_APP_URL = '', $AUTH_CLIENT_APP_URL = '')
    {
        $oauthClient = new \Createlinux\OAuth\Client();
        $oauthClient->setClientId(get_litchi_auth_client_id());
        if ($AUTH_CLIENT_APP_URL) {
            $oauthClient->setOpenAuthClientURIForDev(get_litchi_auth_client_app_url());
        }
        if ($AUTH_SERVER_APP_URL) {
            $oauthClient->setOpenAuthServerURIForDev(get_litchi_auth_server_app_url());
        }
        return $oauthClient;
    }
}