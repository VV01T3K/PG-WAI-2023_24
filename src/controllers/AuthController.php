<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Application;


class AuthController extends Controller
{
    public function login($request)
    {
        $body = $request->getBody();

        $DBuser = Application::$app->db->get_user($body['login']);

        if (
            $DBuser !== null &&
            password_verify($body['password'], $DBuser['password'])
        ) {
            session_regenerate_id();
            $_SESSION['user_id'] = $DBuser['_id'];
            $_SESSION['user_login'] = $DBuser['login'];
            header('Location: /');
            return "Logged in";
        } else {
            return "Wrong login or password";
        }

    }
    public function register($request)
    {
        $body = $request->getBody();

        if ($body['password'] !== $body['password_confirm']) {
            return "Passwords don't match";
        }

        $hash = password_hash($body['password'], PASSWORD_DEFAULT);
        $user = [
            'login' => $body['login'],
            'email' => $body['email'],
            'password' => $hash,
        ];
        Application::$app->db->save_user($user);
        return "Registered";
    }
    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: /');
    }
}