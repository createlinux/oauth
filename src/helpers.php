<?php

use \Createlinux\OAuth\Client;

const LITCHI_AUTH_CLIENT_ID_NAME = 'LITCHI_AUTH_CLIENT_ID';
const LITCHI_AUTH_CLIENT_SECRET = 'LITCHI_AUTH_CLIENT_SECRET';
const LITCHI_AUTH_CLIENT_APP_URL_NAME = 'LITCHI_AUTH_CLIENT_APP_URL';
const LITCHI_AUTH_SERVER_APP_URL_NAME = 'LITCHI_AUTH_SERVER_APP_URL';
const LITCHI_AUTH_CLIENT_REDIRECT_URI = 'LITCHI_AUTH_CLIENT_REDIRECT_URI';

if (!function_exists('get_litchi_auth_client_key')) {
    function get_litchi_auth_client_id()
    {
        return getenv(LITCHI_AUTH_CLIENT_ID_NAME);
    }
}
if (!function_exists('get_litchi_auth_client_app_uri')) {
    function get_litchi_auth_client_app_uri()
    {
        return getenv(LITCHI_AUTH_CLIENT_APP_URL_NAME);
    }
}
if (!function_exists('get_litchi_auth_server_app_uri')) {
    function get_litchi_auth_server_app_uri()
    {
        return getenv(LITCHI_AUTH_SERVER_APP_URL_NAME);
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
        return getenv(LITCHI_AUTH_CLIENT_SECRET);
    }
}

if (!function_exists('get_litchi_auth_redirect_uri')) {
    function get_litchi_auth_redirect_uri()
    {
        return getenv(LITCHI_AUTH_CLIENT_REDIRECT_URI);
    }
}