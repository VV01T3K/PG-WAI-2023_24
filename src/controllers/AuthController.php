<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Application;
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

            $LoginModel = new LoginModel();
            $LoginModel->loadData($request->getBody());

            if ($LoginModel->validate())
                return $this->render('login', $LoginModel);

            $LoginModel->login();
            // header('Location: /');
            return "Logged in";
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

            return "Registered";
        }
        return $this->renderHttpCode(405);
    }
}