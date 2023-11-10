<?php

namespace app\models;

use app\core\Application;

class ModelGalleryPage
{
    public $page = 1;
    public $max_page;
    public $images = [];
    private $pageSize = 5;
    public function __construct()
    {
        $this->max_page = Application::$app->db->get_max_page_images($this->pageSize);
    }
    public function setPage($pageNumber)
    {
        $this->page = $pageNumber > $this->max_page ? $this->max_page : $pageNumber;
    }
    public function getImages()
    {
        $this->images = Application::$app->db->get_page_images($this->page, $this->pageSize);
    }
}