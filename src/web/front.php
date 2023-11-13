<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../CONFIG.php';

use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;

session_start();

$app = new Application(dirname(__DIR__), $CONFIG);


$app->router->get('/', [SiteController::class, 'home']);

$app->router->get('/image', [SiteController::class, 'image']);
$app->router->post('/image', [SiteController::class, 'image']);

$app->router->get('/gallery', [SiteController::class, 'gallery']);
$app->router->put('/gallery', [SiteController::class, 'gallery']);

$app->router->get('/favorites', [SiteController::class, 'favorites']);
$app->router->delete('/favorites', [SiteController::class, 'favorites']);

$app->router->get('/search', [SiteController::class, 'search']);
$app->router->post('/search', [SiteController::class, 'search']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->router->get('/logout', [AuthController::class, 'logout']);

$app->run();