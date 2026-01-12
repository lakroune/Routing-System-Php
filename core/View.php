<?php

namespace Core;

class View{

    public function __construct(
        private $view,
        private $params
    ){

    }

    public static function make($view, $params = []){
        return new static($view, $params);
        //  static is a keyword that refers to the current class
    }

/*************  ✨ Windsurf Command ⭐  *************/
/**
 * Renders the given view.
 *
 * @return string The rendered view
 */
/*******  e30ef008-0271-4871-a06e-e6e1b5e31fb8  *******/
    public function render(){
        ob_start();
        // extract() is a function that takes an array of variables and makes them available in the current scope
        include __DIR__.'/../app/views/'.$this->view.'.php'; 
        // include() is a function that includes a file
        return ob_get_clean();
        // ob_get_clean() is a function that returns the contents of the output buffer

    }

/*************  ✨ Windsurf Command ⭐  *************/
/**
 * Returns the rendered view as a string.
 *
 * This magic method is used to convert the View object to a string.
 * It is called when the View object is used in a string context.
 *
 * @return string The rendered view as a string.
 */
/*******  8ed22820-701e-4607-9f7a-cc5aa0bb9172  *******/
    public function __toString(){
        return $this->render();
    }
}