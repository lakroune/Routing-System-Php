<?php

namespace Core;

use Exception;

class View
{
    private $view;
    private $params;

    public function __construct($view, $params)
    {
        $this->view = $view;
        $this->params = $params;
    }

    public static function make($view, $params = [])
    {
        return new static($view, $params);
    }

    public function render()
    {
        ob_start();
        extract($this->params);

        $file = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $this->view) . '.php';

        if (!file_exists($file)) {
            throw new Exception("View file not found: $file");
        }
        include $file;
        return ob_get_clean();
    }

    public function __toString()
    {
        return $this->render();
    }
}
