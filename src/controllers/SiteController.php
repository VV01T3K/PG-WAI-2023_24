<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'powitanie' => "Serdecznie"
        ];
        return $this->render('home', $params);
    }
    public function form()
    {
        return $this->render('form');
    }
    public function handleForm($request)
    {
        $body = $request->getBody();
        echo '<pre>';
        var_dump($body);
        echo '</pre>';
        return "Handling submitted form";
    }
    public function handleAdd($request)
    {
        $product = $request->getBody();

        Application::$app->db->save_product($product);

        return "inserted";
    }

    public function login()
    {
        return $this->render('login');
    }
    public function register()
    {
        return $this->render('register');
    }

}