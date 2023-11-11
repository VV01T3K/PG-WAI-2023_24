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

            $_SESSION['fav'] = $body;

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

            return $this->render('image', ['msg' => "Images are ready!!"]);
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

            if (empty($phrase))
                return "Brak frazy do wyszukania!";

            $galleryPage = new GalleryPageModel(1);

            if ($galleryPage->getMatchingImages($phrase) === false)
                return "Brak wyników wyszukiwania!";

            return $this->renderPartial('/partials/galleryPage', $galleryPage);
        }

        if ($request->isGET())
            return $this->render('search');

        return $this->renderHttpCode(405);
    }
}