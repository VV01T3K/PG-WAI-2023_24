<?php
namespace app\core;

use MongoDB\Client;
use MongoDB\BSON\ObjectId;

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

    public function save_image($img)
    {

        $this->connection->gallery->insertOne($img);

    }
    public function get_page_images($page, $pageSize, $params = [false])
    {
        echo "<pre>";
        var_dump($params);
        echo "</pre>";

        if ($params !== [false]) {
            $query = ['_id' => ['$in' => array_map([$this, "oID"], $params)]];
        } else {
            $query = [
                '$or' => [
                    ['visibility' => 'public'],
                    [
                        'visibility' => 'private',
                        'sharer_id' => ($_SESSION['user_id'] ?? false),
                    ],
                ],
            ];
        }
        $options = [
            'skip' => ($page - 1) * $pageSize,
            'limit' => $pageSize,
        ];

        $images = $this->connection->gallery->find($query, $options);

        return $images;
    }
    public function get_max_page_images($pageSize)
    {
        $count = $this->connection->gallery->count();
        return ceil($count / $pageSize);
    }
    public function save_user($user)
    {
        $this->connection->users->insertOne($user);
    }
    public function delete_user($user)
    {
        $this->connection->users->deleteOne($user);
    }
    // utils ⬇️ ---------------------------------------
    public function oID($string)
    {
        $id = new ObjectId($string);
        return $id;
    }
    public function get_user($login)
    {
        return ($this->connection->users->findOne(['login' => $login]));
    }
    public function user_exists($user)
    {
        $existing_user = NULL;
        if (is_array($user)) {
            $existing_user = $this->connection->users->findOne(['login' => $user['login']]);
        } else {
            $existing_user = $this->connection->users->findOne(['login' => $user]);
        }

        return $existing_user ? true : false;


    }
}