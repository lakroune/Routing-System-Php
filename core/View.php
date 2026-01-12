<?php

namespace Core;

class View
{
    private $view;
    private $params;

    
    /**
     * Initializes a new View instance.
     *
     * @param string $view The view to render.
     * @param array $params The parameters to pass to the view.
     */
    public function __construct($view, $params)
    {
        $this->view = $view;
        $this->params = $params;
    }

    /**
     * Make a new View instance.
     *
     * @param string $view The view to render.
     * @param array $params The parameters to pass to the view.
     * @return static A new View instance.
     */
    public static function make($view, $params = [])
    {
        return new static($view, $params);
        // new static() is a function that creates a new instance of the class
    }

    /**
     * Renders the view.
     *
     * Uses output buffering to capture the rendered view. The view is included
     * and the parameters are extracted into the current scope using extract().
     *
     * @return string The rendered view.
     */
    public function render()
    {
        ob_start();
        // extract() is a function that takes an array of variables and makes them available in the current scope
        include __DIR__ . '/../app/views/' . $this->view . '.php';
        // include() is a function that includes a file
        return ob_get_clean();
        // ob_get_clean() is a function that returns the contents of the output buffer

    }

    /**
     * Converts the view to a string.
     *
     * When the view is converted to a string, it is rendered and the result is returned.
     *
     * @return string The rendered view.
     */
    public function __toString()
    {
        return $this->render();
    }
}
