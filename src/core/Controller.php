<?php

namespace app\core;

class Controller
{
    protected $valid_types = [
        'image/png',
        'image/jpg',
        'image/jpeg',
    ];
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
    public function miniaturize($source, $width, $height)
    {

        $type = mime_content_type($source);
        $name = basename($source);
        // $path = Application::$ROOT . "/web/Images/thumbnails/mini_$name";
        $path = Application::$ROOT . "/web/Images/original/mini_$name";

        if ($type == 'image/png')
            $img = imagecreatefrompng($source);
        else
            $img = imagecreatefromjpeg($source);

        $img = imagescale($img, $width, $height);

        if ($type == 'image/png')
            imagepng($img, $path);
        else
            imagejpeg($img, $path);

        imagedestroy($img);
    }
    public function watermark($source, $text)
    {
        $type = mime_content_type($source);
        $name = basename($source);
        // $path = Application::$ROOT . "/web/Images/watermark/watermarked_$name";
        $path = Application::$ROOT . "/web/Images/original/watermarked_$name";

        if ($type == 'image/png')
            $img = imagecreatefrompng($source);
        else
            $img = imagecreatefromjpeg($source);


        $white = imagecolorallocate($img, 255, 255, 255);
        $font = Application::$ROOT . "/web/static/fonts/Geist/GeistVariableVF.ttf";
        $size = 30;
        $angle = 0;
        $x = $size / 2;
        $y = $size * 1.5;
        imagettftext($img, $size, $angle, $x, $y, $white, $font, $text);


        if ($type == 'image/png')
            imagepng($img, $path);
        else
            imagejpeg($img, $path);

        imagedestroy($img);

    }

}