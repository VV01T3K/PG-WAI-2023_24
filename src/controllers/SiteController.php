<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\models\ImageModel;
use app\models\GalleryPageModel;

class SiteController extends Controller
{
    public function gallery($request)
    {
        if ($request->isGET()) {

            $pageNumber = $request->getBody()['page'] ?? 1;

            $galleryPage = new GalleryPageModel($pageNumber);
            $galleryPage->getImages();

            return $this->render('gallery', $galleryPage);
        }

        if ($request->isHTMX() && $request->isPOST()) {

            $body = $request->getBody();

            $_SESSION['fav'] = Controller::readHxPayload($body);

            return "Zapisano!";
        }
        // return $this->renderHttpCode(405);
    }
    public function favorites($request)
    {
        if ($request->isGET()) {

            $pageNumber = $request->getBody()['page'] ?? 1;

            $galleryPage = new GalleryPageModel($pageNumber);
            $galleryPage->getFavoriteImages();

            return $this->render('favorites', $galleryPage);
        }
    }

    public function render_favorites($request)
    {
        $page = $request->getBody()['page'] ?? 1;

        $max_page = Application::$app->db->get_max_page_images($this->pageSize);
        $page = $page > $max_page ? $max_page : $page;
        $images = Application::$app->db->get_page_images($page, $this->pageSize, $_SESSION['fav'] ?? []);

        $params = [
            'images' => $images,
            'page' => $page,
            'max_page' => $max_page,
        ];
        return $this->render('favorites', $params);
    }
    public function image($request)
    {
        if ($request->isGET())
            return $this->render('image');

        if ($request->isPOST()) {

            $imageModel = new ImageModel();
            $imageModel->loadData($request->getBody());
            $imageModel->loadImage($_FILES['img']);

            if ($imageModel->validate())
                return $this->render('image', $imageModel);

            $imageModel->save();

            $imageModel->process();

            return "Images are ready!!";

        }
        return $this->renderHttpCode(405);
    }
    public function home()
    {
        $params = [
            'powitanie' => "Serdecznie"
        ];
        return $this->render('home', $params);
    }
}