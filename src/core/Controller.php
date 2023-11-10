<?php

namespace app\core;

class Controller
{
    protected $pageSize = 10;
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
    public function renderHttpCode(int $code)
    {
        return Application::$app->router->renderView(...Application::$app->response->httpCode($code));
    }
}