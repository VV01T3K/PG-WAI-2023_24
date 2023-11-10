<?php

namespace app\core;

class Response
{
    public static $codes;
    public function __construct()
    {
        self::$codes = [
            200 => 'OK',
            201 => 'Created',
            204 => 'No Content',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error'
        ];
    }
    public function httpCode(int $code)
    {
        http_response_code($code);
        return $this->showCode($code);
    }
    public function showCode(int $code)
    {
        $params = [
            'code' => $code,
            'message' => self::$codes[$code],
        ];
        return ["httpResponse", $params];
    }
}