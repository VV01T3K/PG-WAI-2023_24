<?php
namespace app\core;

class Application
{
    public static $app;
    public static $ROOT;
    public $router;
    public $db;
    public $request;
    public function __construct($root)
    {
        self::$app = $this;
        self::$ROOT = $root;
        $this->request = new Request();
        $this->router = new Router($this->request);
        $this->db = new Business();
    }
    public function run()
    {
        echo $this->router->resolve();
    }
}