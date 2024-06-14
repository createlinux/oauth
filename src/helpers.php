<?php

use \Createlinux\OAuth\Client;

if (!function_exists('get_litchi_auth_client_key')) {
    function get_litchi_auth_client_id()
    {
        return getenv('LITCHI_AUTH_CLIENT_ID');
    }
}
if (!function_exists('get_litchi_auth_center_client_uri')) {
    function get_litchi_auth_center_client_uri()
    {
        if (getenv('APP_ENV') === 'production') {
            return 'https://auth.lizhiruanjian.com';
        }
        return getenv('LITCHI_AUTH_CENTER_CLIENT_URI');
    }
}
if (!function_exists('get_litchi_auth_center_server_uri')) {
    function get_litchi_auth_center_server_uri()
    {
        if (getenv('APP_ENV') === 'production') {
            return 'https://auth-api.lizhiruanjian.com';
        }
        return getenv('LITCHI_AUTH_CENTER_SERVER_URI');
    }
}
if (!function_exists('create_litchi_oauth_client')) {
    function create_litchi_oauth_client()
    {
        return new Client();
    }
}

if (!function_exists('get_litchi_auth_client_secret')) {
    function get_litchi_auth_client_secret()
    {
        return getenv('LITCHI_AUTH_CLIENT_SECRET');
    }
}

if (!function_exists('get_litchi_auth_client_redirect_uri')) {
    function get_litchi_auth_client_redirect_uri()
    {
        return getenv('LITCHI_AUTH_CLIENT_REDIRECT_URI');
    }
}

if (!function_exists('get_litchi_access_token')) {
    function get_litchi_access_token()
    {
        $headers = getallheaders();
        return explode(" ",$headers['Authorization'])[1] ?? '';
    }
}