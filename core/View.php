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