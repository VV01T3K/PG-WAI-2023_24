<?php

namespace app\models;

use app\core\Model;
use app\core\Application;

class ImageModel extends Model
{
    private $valid_types = [
        'image/png',
        'image/jpg',
        'image/jpeg',
    ];
    private $maxSize = 1000000;
    public $watermark;
    public $author;
    public $title;
    public $visibility = 'public';
    public $name;
    public $type;
    public $tmp_path;
    public $size;
    public $thumb;

    public $path;

    public function process()
    {
        $this->miniaturize(200, 125);
        $this->watermark();
    }
    public function save()
    {
        $this->path = Application::$ROOT . "/web/Images/original/" . $this->name;
        if (!move_uploaded_file($this->tmp_path, $this->path))
            return "Błąd przy przesyłaniu danych!";

        $imgDB = [
            'sharer_id' => ($_SESSION['user_id'] ?? false),
            'name' => $this->name,
            'author' => $this->author,
            'title' => $this->title,
            'visibility' => $this->visibility,
        ];

        Application::$app->db->save_image($imgDB);
    }

    public function validate()
    {
        if (empty($this->watermark))
            $this->errors += ['watermark' => "Watermark empty"];
        if (empty($this->author))
            $this->errors += ['author' => "Author empty"];
        if (empty($this->title))
            $this->errors += ['title' => "Title empty"];

        if ($this->size > $this->maxSize)
            return "Plik jest za duży!";
        if (!in_array($this->type, $this->valid_types))
            return "Nieprawidłowy format pliku!";

        return $this->errors;
    }
    public function miniaturize($width, $height)
    {

        $path = Application::$ROOT . "/web/Images/thumbnails/mini_$this->name";

        if ($this->type == 'image/png')
            $img = imagecreatefrompng($this->path);
        else
            $img = imagecreatefromjpeg($this->path);

        $img = imagescale($img, $width, $height);

        if ($this->type == 'image/png')
            imagepng($img, $path);
        else
            imagejpeg($img, $path);

        imagedestroy($img);
    }
    public function watermark()
    {
        $path = Application::$ROOT . "/web/Images/watermark/watermarked_$this->name";

        if ($this->type == 'image/png')
            $img = imagecreatefrompng($this->path);
        else
            $img = imagecreatefromjpeg($this->path);

        $opacity = 0.5;
        $font_size = 20;
        $font = Application::$ROOT . "/web/static/fonts/Geist.Mono/GeistMono-SemiBold.otf";

        $color = imagecolorallocatealpha($img, 220, 20, 60, (1 - $opacity) * 127);
        $angle = -15;
        $x = $font_size / 2;
        $y = $font_size * 1.5;
        imagettftext($img, $font_size, $angle, $x, $y, $color, $font, $this->watermark);


        if ($this->type == 'image/png')
            imagepng($img, $path);
        else
            imagejpeg($img, $path);

        imagedestroy($img);

    }
}