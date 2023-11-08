<?php

namespace app\core;

class Controller
{
    protected $valid_types = [
        'image/png',
        'image/jpg',
        'image/jpeg',
    ];
    protected $pageSize = 10;
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
    public function miniaturize($source, $width, $height)
    {

        $type = mime_content_type($source);
        $name = basename($source);
        $path = Application::$ROOT . "/web/Images/thumbnails/mini_$name";

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
        $path = Application::$ROOT . "/web/Images/watermark/watermarked_$name";

        if ($type == 'image/png')
            $img = imagecreatefrompng($source);
        else
            $img = imagecreatefromjpeg($source);

        $opacity = 0.5;
        $font_size = 20;
        $font = Application::$ROOT . "/web/static/fonts/Geist.Mono/GeistMono-SemiBold.otf";

        $color = imagecolorallocatealpha($img, 220, 20, 60, (1 - $opacity) * 127);
        $angle = -15;
        $x = $font_size / 2;
        $y = $font_size * 1.5;
        imagettftext($img, $font_size, $angle, $x, $y, $color, $font, $text);


        if ($type == 'image/png')
            imagepng($img, $path);
        else
            imagejpeg($img, $path);

        imagedestroy($img);

    }

}