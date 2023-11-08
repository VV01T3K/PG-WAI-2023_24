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
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            http_response_code(404);
            return $this->renderView("status_404");
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
        foreach ($params as $key => $value) {
            // uses $key(string) as a name for new variable
            $$key = $value;
        }

        include_once Application::$ROOT . "/views/partials/header.php";

        if ($_SESSION['user_id'] ?? false) {
            echo " <a href='/logout'>Logout</a>";
            echo "<br><div class='user'>Logged in as: " . $_SESSION['user_login'] . "</div>";
        }

        include_once Application::$ROOT . "/views/$view.php";

        include_once Application::$ROOT . "/views/partials/footer.php";
    }


}