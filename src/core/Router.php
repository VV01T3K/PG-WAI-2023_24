<?php
namespace app\core;

class Router
{
    public $request;
    protected $routes = [];
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }
    public function delete($path, $callback)
    {
        $this->routes['delete'][$path] = $callback;
    }
    public function put($path, $callback)
    {
        $this->routes['put'][$path] = $callback;
    }
    public function patch($path, $callback)
    {
        $this->routes['patch'][$path] = $callback;
    }
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            return $this->renderView(...Application::$app->response->httpCode(404));
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            // creates new instance of class
            // bo Deprecated pokazywalo itd.
            $callback[0] = new $callback[0]();
        }
        return call_user_func($callback, $this->request);
    }
    public function renderView($view, $params = [])
    {

        $msg = $_SESSION["msg"] ?? "";
        unset($_SESSION["msg"]);
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        include_once Application::$ROOT . "/views/partials/header.php";

        include_once Application::$ROOT . "/views/$view.php";

        include_once Application::$ROOT . "/views/partials/footer.php";
    }
    public function renderPartialView($view_path, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        include_once Application::$ROOT . "/views$view_path.php";
    }
    public function redirect($url, $params = [])
    {
        if ($params) 
            $_SESSION["msg"] = $params["msg"];
        header("Location: $url");
        exit;
    }


}