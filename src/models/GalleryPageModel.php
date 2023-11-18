<?php

namespace app\models;

use app\core\Application;

class GalleryPageModel
{
    public $page = 1;
    public $max_page;
    public $images = [];
    public $msg = "";
    public function __construct($pageNumber)
    {
        $this->page = $pageNumber;
    }
    public function getImages()
    {
        list($this->images, $this->max_page) = Application::$app->db->getGalleryPage($this->page);
        if ($this->page == 0) {
            $this->images = [];
            $this->msg = "No images in gallery!";
        }
    }
    public function getFavoriteImages()
    {
        list($this->images, $this->max_page) = Application::$app->db->getGalleryPage($this->page, $_SESSION['fav'] ?? []);
    }
    public function getMatchingImages($phrase)
    {
        if (!empty($phrase)) {
            list($this->images, $this->max_page) = Application::$app->db->searchImages($this->page, $phrase);
            if ($this->images == NULL) {
                $this->images = [];
                $this->msg = "No images matching phrase!";
            }
        } else {
            $this->msg = "No phrase given!";
        }


    }
}