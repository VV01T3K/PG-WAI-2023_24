<?php

namespace app\core;

class Model
{
    public $errors = [];
    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key))
                $this->{$key} = $value;
        }
    }
    public function loadImage($file)
    {
        if (isset($file['tmp_name']) && !empty($file['tmp_name'])) {
            $this->name = basename($file['name']);
            $this->type = mime_content_type($file['tmp_name']);
            $this->tmp_path = $file['tmp_name'];
            $this->size = $file['size'];
        } else {
            $this->errors += ['img' => "Image file empty"];
        }
    }
}