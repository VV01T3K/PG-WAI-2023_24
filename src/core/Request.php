<?php
namespace app\core;

class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }
    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    public function getBody()
    {
        $body = [];

        if ($this->isHTMX()) {
            $body = json_decode(file_get_contents('php://input'), true);
        }

        if ($this->isGET()) {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->isPOST()) {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;

    }
    public function isPOST()
    {
        return $this->getMethod() === 'post';
    }
    public function isGET()
    {
        return $this->getMethod() === 'get';
    }
    public function isHEAD()
    {
        return $this->getMethod() === 'head';
    }
    public function isPUT()
    {
        return $this->getMethod() === 'put';
    }
    public function isDELETE()
    {
        return $this->getMethod() === 'delete';
    }
    public function isPATCH()
    {
        return $this->getMethod() === 'patch';
    }
    public function isHTMX()
    {
        return (strtolower($_SERVER['HTTP_HX_REQUEST'] ?? false) === 'true');
    }

}