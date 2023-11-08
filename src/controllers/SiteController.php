<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;

class SiteController extends Controller
{
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
        if (move_uploaded_file($tmp_path, $path)) {
            $this->miniaturize($path, 200, 125);
            $this->watermark($path, $watermark);
            return "Upload przebiegł pomyślnie!";
        } else {
            return "Błąd przy przesyłaniu danych!";
        }

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