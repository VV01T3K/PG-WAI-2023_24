<?php

namespace app\core;

class Model
{
    public $errors = [];
    public $file_status;
    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key))
                $this->{$key} = $value;
        }
    }
    public function loadImage($file)
    {
        if (file_exists($file['tmp_name'])) {
            $this->name = basename($file['name']);
            $this->type = mime_content_type($file['tmp_name']);
            $this->tmp_path = $file['tmp_name'];
            $this->size = $file['size'];
            $this->file_status = true;
        } else {
            $this->file_status = false;
        }
    }
}