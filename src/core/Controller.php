<?php

namespace app\core;

class Controller
{
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
    public function renderPartial($view, $params = [])
    {
        return Application::$app->router->renderPartialView($view, $params);
    }
    public function renderHttpCode(int $code)
    {
        return Application::$app->router->renderView(...Application::$app->response->httpCode($code));
    }
}