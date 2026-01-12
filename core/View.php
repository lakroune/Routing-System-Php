<?php

namespace Core;

class View{

/*************  ✨ Windsurf Command ⭐  *************/
/**
 * Constructor
 *
 * @param string $view The view to render
 * @param array $params The parameters to pass to the view
 */
/*******  2a6a1fbe-b9d5-46b7-a564-9caa8e9a395b  *******/
    public function __construct(
        private $view,
        private $params
    ){

    }

/*************  ✨ Windsurf Command ⭐  *************/
/**
 * Creates a new View instance.
 *
 * @param string $view The view to render
 * @param array $params The parameters to pass to the view
 * @return static
 */
/*******  c580705a-94d6-4392-9cfa-7ad1721d29c9  *******/
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

    public function __toString(){
        return $this->render();
    }
}