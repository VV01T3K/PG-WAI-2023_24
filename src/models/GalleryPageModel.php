<?php

namespace app\models;

use app\core\Application;

class GalleryPageModel
{
    public $page = 1;
    public $max_page;
    public $images = [];
    public $msg = "";
    private $pageSize = 10;
    public function __construct($pageNumber)
    {
        $this->page = $pageNumber;
    }
    public function getImages()
    {
        list($this->images, $this->max_page) = Application::$app->db->getGalleryPage($this->page, $this->pageSize);
        if ($this->page == 0) {
            $this->images = [];
            $this->msg = "Brak obrazów w galerii!";
        }
    }
    public function getFavoriteImages()
    {
        list($this->images, $this->max_page) = Application::$app->db->getGalleryPage($this->page, $this->pageSize, $_SESSION['fav'] ?? []);
    }
    public function getMatchingImages($phrase)
    {
        if (!empty($phrase)) {
            list($this->images, $this->max_page) = Application::$app->db->searchImages($this->page, $this->pageSize, $phrase);
            if ($this->images == NULL) {
                $this->images = [];
                $this->msg = "Brak wyników wyszukiwania!";
            }
        } else {
            $this->msg = "Brak frazy do wyszukania!";
        }


    }
}