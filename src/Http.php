<?php

namespace Createlinux\OAuth;

class Http
{
    public static function post(string $url, array $data, array $header = [])
    {
        $headers = [
            'Content-Type: application/json'
        ];
        $headers = array_merge($headers, $header);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public static function delete(string $url, $accessToken)
    {
        $headers = [
            'Content-Type: application/json'
        ];
        $headers = array_merge($headers, [
            'Authorization: bearer '.$accessToken
        ]);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public static function get(string $url, array $data, array $header = [])
    {
        $headers = [
            'Content-Type: application/json'
        ];
        $headers = array_merge($headers, $header);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}