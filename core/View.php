<?php

namespace Core;

use Exception;

class View
{
    private $view;
    private $params;

/**
 * Construct a new View instance.
 *
 * @param string $view The view to render
 * @param array $params The parameters to pass to the view
 */
    public function __construct($view, $params)
    {
        $this->view = $view;
        $this->params = $params;
    }

/**
 * Creates a new View instance.
 *
 * @param string $view The view to render
 * @param array $params The parameters to pass to the view
 *
 * @return View The created View instance
 */
    public static function make($view, $params = [])
    {
        return new static($view, $params);
    }

/**
 * Renders the view.
 *
 * The view is rendered by including the view file and passing the
 * parameters to it. The rendered view is then returned.
 *
 * @return string The rendered view
 *
 * @throws Exception If the view file is not found
 */
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


/**
 * Returns the rendered view as a string.
 *
 * This magic method is called when the View instance is converted to a string.
 * It returns the rendered view as a string.
 *
 * @return string The rendered view
 */
    public function __toString()
    {
        return $this->render();
    }
}
