<?php

namespace app\models;

use app\core\Model;
use app\core\Application;

class LoginModel extends Model
{

    public $login;
    public $password;
    private $user = false;

    public function login()
    {
        session_regenerate_id();
        $_SESSION['user_id'] = $this->user['_id'];
        $_SESSION['user_login'] = $this->user['login'];

    }

    public function validate()
    {
        if (empty($this->login))
            $this->errors += ['login' => "Login empty"];

        if (!Application::$app->db->user_exists($this->login)) {
            $this->errors += ['login' => "User doesn't exist"];
        } else {
            $this->user = Application::$app->db->get_user($this->login);
        }

        if (empty($this->password))
            $this->errors += ['password' => "Password empty"];

        if ($this->user && !password_verify($this->password, $this->user['password']))
            $this->errors += ['password' => "Wrong password"];

        return $this->errors;
    }

}