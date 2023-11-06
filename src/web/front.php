<?php

require_once __DIR__ . '/../../vendor/autoload.php';
use core\App;

use controllers\controllers;

$app = new App(dirname(__DIR__));

$app->router->get('/', 'home');
$app->router->get('/contact', 'contact');
$app->router->get('/form', 'form');
$app->router->post('/form', array(controllers::class, 'form'));


$app->run();