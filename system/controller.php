<?php

class Controller {
    
    public function loadModel($model) {
        //require_once(MVC_MODELS . strtolower($this->replacePipe($modelName)) . '.php');
        require_once(UString::replacePipe(MVC_MODELS . strtolower($model) . '.php'));
    }
    
    public function loadView($view, $navbar = true) {
        //return new View($this->replacePipe($viewName), $navbar);
        return new View(UString::replacePipe($view), $navbar);
    }
    
    public function loadClass($class) {
        //require_once(APP_DIR . 'classes' . DS . strtolower($this->replacePipe($className)) . '.php');
        require_once(UString::replacePipe(APP_DIR . 'classes|' . strtolower($class) . '.php'));
    }
    
    public static function navigate($location) {
        $url = Request::resolveUrl($location);
        header('Location: ' . $url);
    }
}