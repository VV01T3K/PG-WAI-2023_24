<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;

session_start();

$app = new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', 'contact');
$app->router->get('/form', [SiteController::class, 'form']);
$app->router->post('/form', [SiteController::class, 'handleForm']);

$app->router->get('/login', [SiteController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/register', [SiteController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->router->get('/logout', [AuthController::class, 'logout']);

$app->router->get('/add', 'add');
$app->router->post('/add', [SiteController::class, 'handleAdd']);

$app->run();