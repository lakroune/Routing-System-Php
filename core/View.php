<?php

namespace Core;

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
        include __DIR__ . '/../app/Views/' . $this->view . '.php';
        return ob_get_clean();
    }

    public function __toString()
    {
        return $this->render();
    }
}
