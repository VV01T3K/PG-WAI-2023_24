<?php
namespace core;

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
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        echo "<pre>";
        var_dump($callback);
        echo "</pre>";
        if ($callback === false) {
            http_response_code(404);
            return $this->renderView("status_404");
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        return call_user_func($callback);
    }
    public function renderView($view)
    {
        include_once App::$ROOT . "/views/partials/header.php";

        include_once App::$ROOT . "/views/$view.php";

        include_once App::$ROOT . "/views/partials/footer.php";
    }


}