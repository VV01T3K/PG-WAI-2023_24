<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;

session_start();

$app = new Application(dirname(__DIR__));


$app->router->get('/', [SiteController::class, 'render_home']);


$app->router->get('/image', [SiteController::class, 'render_image']);
$app->router->post('/image', [SiteController::class, 'handle_image']);



$app->router->get('/register', [AuthController::class, 'render_register']);
$app->router->get('/login', [AuthController::class, 'render_login']);
$app->router->get('/logout', [AuthController::class, 'handle_logout']);

$app->router->post('/register', [AuthController::class, 'handle_logout']);
$app->router->post('/login', [AuthController::class, 'handle_logout']);



$app->run();