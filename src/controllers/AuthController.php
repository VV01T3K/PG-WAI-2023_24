<?php

namespace app\controllers;

use app\core\Controller;
use app\models\RegisterModel;
use app\models\LoginModel;


class AuthController extends Controller
{
    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: /');
    }
    public function login($request)
    {
        if ($request->isGET())
            return $this->render('login');

        if ($request->isPOST()) {

            $loginModel = new LoginModel();
            $loginModel->loadData($request->getBody());

            if ($loginModel->validate())
                return $this->render('login', $loginModel);

            $loginModel->login();

            return $this->render('login', ['msg' => "Logged in as " . $_SESSION["user_login"]]);
        }
        return $this->renderHttpCode(405);
    }

    public function register($request)
    {
        if ($request->isGET())
            return $this->render('register');

        if ($request->isPOST()) {

            $registerModel = new RegisterModel();
            $registerModel->loadData($request->getBody());

            if ($registerModel->validate())
                return $this->render('register', $registerModel);

            $registerModel->register();

            return $this->render('register', ['msg' => "Registered"]);
        }
        return $this->renderHttpCode(405);
    }
}