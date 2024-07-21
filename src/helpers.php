<?php

use \Createlinux\OAuth\Client;

if(!function_exists('get_all_headers')){
    function get_all_headers() {
        $headers = array();
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headerName = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))));
                $headers[$headerName] = $value;
            }
        }
        return $headers;
    }
}

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
        $headers = get_all_headers();
        if(isset($headers['authorization'])){
            return explode(" ", $headers['authorization'] ?? '')[1] ?? '';
        }
        return explode(" ", $headers['Authorization'] ?? '')[1] ?? '';
    }
}