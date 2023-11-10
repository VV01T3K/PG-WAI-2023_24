<?php

namespace app\core;

class Controller
{
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
    public function renderHttpCode(int $code)
    {
        return Application::$app->router->renderView(...Application::$app->response->httpCode($code));
    }
    public static function readHxPayload($payload)
    {
        return json_decode(html_entity_decode($payload['payload']));
    }
}