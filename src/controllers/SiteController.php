<?php

namespace app\controllers;

use app\core\Controller;
use app\models\ImageModel;
use app\models\GalleryPageModel;

class SiteController extends Controller
{
    public function gallery($request)
    {

        if ($request->isHTMX() && $request->isPUT()) {

            $body = $request->getBody();

            if (!isset($_SESSION['fav']))
                $_SESSION['fav'] = [];

            foreach ($body as $item) {
                if (!in_array($item, $_SESSION['fav'])) {
                    $_SESSION['fav'][] = $item;
                }
            }

            return "Zapisano!";
        }

        if ($request->isGET()) {

            $pageNumber = $request->getBody()['page'] ?? 1;

            $galleryPage = new GalleryPageModel($pageNumber);
            $galleryPage->getImages();

            return $this->render('gallery', $galleryPage);
        }

        return $this->renderHttpCode(405);
    }
    public function favorites($request)
    {
        if ($request->isHTMX() && $request->isDELETE()) {

            $body = $request->getBody();

            $_SESSION['fav'] =
                array_values(
                    array_diff(
                        $_SESSION['fav'],
                        $body ?? []
                    )
                );

            return "Usunięto!";
        }
        if ($request->isGET()) {

            $pageNumber = $request->getBody()['page'] ?? 1;

            $galleryPage = new GalleryPageModel($pageNumber);

            $galleryPage->getFavoriteImages();

            return $this->render('favorites', $galleryPage);
        }
        return $this->renderHttpCode(405);
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

            return $this->render('image', ['msg' => "Finished sending and processing image!!"]);
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
    public function search($request)
    {

        if ($request->isHTMX() && $request->isPOST()) {

            $phrase = $request->getBody()['phrase'] ?? "";

            $galleryPage = new GalleryPageModel(1);

            $galleryPage->getMatchingImages($phrase);

            return $this->renderPartial('/partials/galleryPage', $galleryPage);
        }

        if ($request->isGET())
            return $this->render('search', ['msg' => "Brak frazy do wyszukania!"]);

        return $this->renderHttpCode(405);
    }
}