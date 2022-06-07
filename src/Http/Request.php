<?php

namespace Tringuyen\CarForRent\Http;

class Request
{
    /**
     * @return string
     */
    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if (!$position) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function isGetMethod()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }
    public function isPostMethod()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }
    /**
     * @return array
     */
    public function getBody()
    {
        $body = [];
        foreach ($_POST as $key => $value) {
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $body;
    }
    public function getJSONBody()
    {
        $body = file_get_contents('php://input');
        if ($this->getMethod() == 'POST') {
            $data = json_decode($body, true);
        }
        return $data;
    }
}
