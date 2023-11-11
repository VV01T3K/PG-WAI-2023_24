<?php
namespace app\core;

class Application
{
    public static $app;
    public static $ROOT;
    public $router;
    public $db;
    public $request;
    public $response;
    public static $PAGE_SIZE;
    public static $DB_HOST;
    public static $DB_USER;
    public static $DB_PASS;

    public function __construct($root, $CONFIG = [])
    {
        if (!isset($CONFIG['DB_HOST'])) {
            echo ("DB_HOST not set in config");
            exit;
        }
        if (!isset($CONFIG['DB_USER'])) {
            echo ("DB_USER not set in config");
            exit;
        }
        if (!isset($CONFIG['DB_PASS'])) {
            echo ("DB_PASS not set in config");
            exit;
        }
        self::$PAGE_SIZE = $CONFIG['PAGE_SIZE'] ?? 10;
        self::$DB_HOST = $CONFIG['DB_HOST'];
        self::$DB_USER = $CONFIG['DB_USER'];
        self::$DB_PASS = $CONFIG['DB_PASS'];

        self::$app = $this;
        self::$ROOT = $root;
        $this->request = new Request();
        $this->router = new Router($this->request);
        $this->db = new Business();
        $this->response = new Response();
    }
    public function run()
    {

        $this->makeDir("Images");
        $this->makeDir("Images/original");
        $this->makeDir("Images/thumbnail");
        $this->makeDir("Images/watermark");

        echo $this->router->resolve();
    }
    private function makeDir($path)
    {
        return is_dir($path) || mkdir($path);
    }
}