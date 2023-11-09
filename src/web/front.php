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

$app->router->get('/galery', [SiteController::class, 'render_galery']);
$app->router->post('/galery_favs', [SiteController::class, 'save_fav_galery']);
// $app->router->delete('/galery_favs', [SiteController::class, 'delete_fav_galery']);

$app->router->get('/favorites', [SiteController::class, 'render_favorites']);

$app->router->get('/login', [AuthController::class, 'render_login']);
$app->router->post('/login', [AuthController::class, 'handle_login']);

$app->router->get('/register', [AuthController::class, 'render_register']);
$app->router->post('/register', [AuthController::class, 'handle_register']);

$app->router->get('/logout', [AuthController::class, 'handle_logout']);



$app->run();