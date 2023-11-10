<?php

namespace app\models;

use app\core\Model;
use app\core\Application;

class RegisterModel extends Model
{

    public $login;
    public $email;
    public $password;
    public $password_confirm;

    public function register()
    {
        $user = [
            'login' => $this->login,
            'email' => $this->email,
            'password' => password_hash($this->password, PASSWORD_DEFAULT),
        ];

        Application::$app->db->save_user($user);
    }

    public function validate()
    {
        if (empty($this->login))
            $this->errors += ['login' => "Login empty"];

        if (Application::$app->db->user_exists($this->login))
            $this->errors += ['login' => "Login is taken"];

        if (empty($this->email))
            $this->errors += ['email' => "Email empty"];

        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false)
            $this->errors += ['email' => "Email is invalid"];

        if (empty($this->password))
            $this->errors += ['password' => "Password empty"];

        if (empty($this->password_confirm))
            $this->errors += ['password_confirm' => "Confirm your password"];

        if ($this->password !== $this->password_confirm)
            $this->errors += ['password_match' => "Passwords don't match"];

        return $this->errors;
    }

}