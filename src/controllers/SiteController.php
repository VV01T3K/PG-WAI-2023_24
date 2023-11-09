<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;

class SiteController extends Controller
{
    public function save_fav_galery($request)
    {

        $body = $request->getBody();

        $_SESSION['fav'] = json_decode(html_entity_decode($body['ids']));

        return "Zapisano!";
    }

    public function render_galery($request)
    {
        $page = $request->getBody()['page'] ?? 1;

        $max_page = Application::$app->db->get_max_page_images($this->pageSize);
        $page = $page > $max_page ? $max_page : $page;
        $images = Application::$app->db->get_page_images($page, $this->pageSize);

        $params = [
            'images' => $images,
            'page' => $page,
            'max_page' => $max_page,
        ];
        return $this->render('galery', $params);
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
    public function render_image()
    {
        return $this->render('image');
    }
    public function handle_image($request)
    {
        $body = $request->getBody();
        $watermark = $body['watermark'];

        $img = $_FILES['img'];
        $tmp_path = $img['tmp_name'];

        $name = basename($img['name']);
        $type = mime_content_type($tmp_path);
        $size = $img['size'];

        // chciałem użyć finfo_open() ale nie działało
        // $finfo = finfo_open(FILEINFO_MIME_TYPE);
        // expected type 'finfo'. Found 'resource|false'.

        // if ($size > 500000)
        //     return "Plik jest za duży!";


        if ($size > 1000000)
            return "Plik jest za duży!";

        if (!in_array($type, $this->valid_types))
            return "Nieprawidłowy format pliku!";


        $path = Application::$ROOT . "/web/Images/original/$name";
        if (!move_uploaded_file($tmp_path, $path))
            return "Błąd przy przesyłaniu danych!";

        $this->miniaturize($path, 200, 125);
        $this->watermark($path, $watermark);

        $imgDB = [
            'sharer_id' => ($_SESSION['user_id'] ?? false),
            'name' => $name,
            'author' => $body['author'],
            'title' => $body['title'],
            'visibility' => $body['visibility'] ?? 'public',
        ];

        Application::$app->db->save_image($imgDB);


        return "Upload przebiegł pomyślnie!";


    }

    public function render_home()
    {
        $params = [
            'powitanie' => "Serdecznie"
        ];
        return $this->render('home', $params);
    }


    // public function form()
    // {
    //     return $this->render('form');
    // }
    // public function handleForm($request)
    // {
    //     $body = $request->getBody();
    //     echo '<pre>';
    //     var_dump($body);
    //     echo '</pre>';
    //     return "Handling submitted form";
    // }
    // public function handleAdd($request)
    // {
    //     $product = $request->getBody();

    //     Application::$app->db->save_product($product);

    //     return "inserted";
    // }

}