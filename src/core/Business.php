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

        if (!$this->collectionExists('users')) {
            $this->connection->createCollection('users');
        }
        if (!$this->collectionExists('gallery')) {
            $this->connection->createCollection('gallery');
        }
    }

    public function saveImage($img)
    {
        $this->connection->gallery->insertOne($img);
    }
    public function getGalleryPage($page, $pageSize, $params = false)
    {
        if ($page < 1)
            $page = 1;

        if (is_array($params)) {
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
    public function searchImages($phrase)
    {
        $query = [
            '$and' => [
                [
                    '$or' => [
                        ['visibility' => 'public'],
                        [
                            'visibility' => 'private',
                            'sharer_id' => ($_SESSION['user_id'] ?? false),
                        ],
                    ],
                ],
                [
                    '$or' => [
                        ['name' => ['$regex' => $phrase, '$options' => 'i']],
                        ['author' => ['$regex' => $phrase, '$options' => 'i']],
                        ['title' => ['$regex' => $phrase, '$options' => 'i']],
                    ],
                ],
            ],
        ];

        $options = [
            'limit' => 10,
        ];

        if ($this->connection->gallery->count($query, $options) == 0)
            return NULL;

        $images = $this->connection->gallery->find($query, $options);

        return $images;
    }
    public function getMaxGalleryPage($pageSize)
    {
        $count = $this->connection->gallery->count();
        return ceil($count / $pageSize);
    }
    public function saveUser($user)
    {
        $this->connection->users->insertOne($user);
    }
    public function deleteUser($user)
    {
        $this->connection->users->deleteOne($user);
    }
    // utils ⬇️ ---------------------------------------
    public function oID($string)
    {
        $id = new ObjectId($string);
        return $id;
    }
    public function getUser($login)
    {
        return ($this->connection->users->findOne(['login' => $login]));
    }
    public function userExists($user)
    {
        $existing_user = NULL;
        if (is_array($user)) {
            $existing_user = $this->connection->users->findOne(['login' => $user['login']]);
        } else {
            $existing_user = $this->connection->users->findOne(['login' => $user]);
        }

        return $existing_user ? true : false;
    }
    public function collectionExists($collectionName)
    {
        $collections = $this->connection->listCollections();
        foreach ($collections as $collection) {
            if ($collection->getName() == $collectionName) {
                return true;
            }
        }
        return false;
    }
}