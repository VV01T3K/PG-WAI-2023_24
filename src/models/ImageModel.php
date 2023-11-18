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
    public $msg;
    public $path;
    private $unique_name;

    public function process()
    {
        $this->miniaturize(200, 125);
        $this->watermark();
    }
    public function save()
    {
        $uniqueID = uniqid();

        $this->unique_name = $uniqueID . "." . pathinfo($this->name, PATHINFO_EXTENSION);

        $this->path = Application::$ROOT . "/web/Images/original/" . $this->unique_name;
        if (!move_uploaded_file($this->tmp_path, $this->path))
            return "Błąd przy przesyłaniu danych!";

        $imgDB = [
            'sharer_id' => ($_SESSION['user_id'] ?? false),
            'file_name' => $this->unique_name,
            'name' => pathinfo($this->name, PATHINFO_FILENAME),
            'author' => $this->author,
            'title' => $this->title,
            'visibility' => $this->visibility,
        ];

        Application::$app->db->saveImage($imgDB);
    }

    public function validate()
    {
        $this->errors['img'] = [];

        if (empty($this->watermark))
            $this->errors += ['watermark' => "Watermark empty!"];
        if (empty($this->author))
            $this->errors += ['author' => "Author empty!"];
        if (empty($this->title))
            $this->errors += ['title' => "Title empty!"];

        if (!in_array($this->type, $this->valid_types))
            $this->errors['img'][0] = "Wrong file type!";
        if ($this->size > $this->maxSize)
            $this->errors['img'][1] = "File too big!";
        if (!$this->file_status) {
            $this->errors['img'][0] = "File empty!";
            $this->errors['img'][1] = false;
        }

        if (empty($this->errors['img']))
            unset($this->errors['img']);
        if ($this->errors)
            $this->msg = "Errors in form!";

        return $this->errors;
    }
    public function miniaturize($width, $height)
    {
        $path = Application::$ROOT . "/web/Images/thumbnail/$this->unique_name";

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
        $path = Application::$ROOT . "/web/Images/watermark/$this->unique_name";

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