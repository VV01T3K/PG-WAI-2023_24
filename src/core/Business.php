<?php
namespace app\core;

use MongoDB\Client;
use MongoDB\BSON\ObjectID;

class Business
{
    private $connection;

    public function __construct()
    {
        $client = new Client(
            "mongodb://localhost:27017/wai",
            [
                'username' => 'wai_web',
                'password' => 'w@i_w3b',
            ]
        );
        $this->connection = $client->wai;
    }
    public function save_product($product)
    {

        $this->connection->products->insertOne($product);

    }
    public function save_user($user)
    {
        if ($this->user_exists($user))
            return "User already exists";

        $this->connection->users->insertOne($user);
    }
    public function delete_user($user)
    {
        if (!$this->user_exists($user))
            return "User doesn't exist";

        $this->connection->users->deleteOne($user);
    }
    // utils ⬇️ ---------------------------------------
    public function get_user($login)
    {
        return $this->connection->users->findOne(['login' => $login]);
    }
    public function user_exists($user)
    {
        if (is_array($user)) {
            $existing_user = $this->get_user(['login' => $user['login']]);
        } else {
            $existing_user = $this->get_user(['login' => $user]);
        }
        if ($existing_user === null) {
            return false;
        } else {
            return true;
        }
    }

}