<?php
namespace core;

class App
{
    public static $ROOT;
    public $router;
    public $db;
    public $request;
    public function __construct($root)
    {
        self::$ROOT = $root;
        $this->request = new Request();
        $this->router = new Router($this->request);
        // $this->db = new Database();
    }
    public function run()
    {
        echo $this->router->resolve();
    }
}