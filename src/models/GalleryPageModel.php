<?php

namespace app\models;

use app\core\Application;

class GalleryPageModel
{
    public $page = 1;
    public $max_page;
    public $images = [];
    private $pageSize = 5;
    public function __construct($pageNumber)
    {
        $this->max_page = Application::$app->db->get_max_page_images($this->pageSize);
        $this->page = $pageNumber > $this->max_page ? $this->max_page : $pageNumber;
    }
    public function getImages()
    {
        $this->images = Application::$app->db->get_page_images($this->page, $this->pageSize);
    }
    public function getFavoriteImages()
    {
        $this->images = Application::$app->db->get_page_images($this->page, $this->pageSize, $_SESSION['fav'] ?? []);
    }
}