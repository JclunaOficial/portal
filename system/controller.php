<?php

// define la ruta general de los modelos, las vistas y los controladores
define('MVC_MODELS', APP_DIR . 'models' . DS);
define('MVC_VIEWS', APP_DIR . 'views' . DS);
define('MVC_CONTROLLERS', APP_DIR . 'controllers' . DS);

class Controller {
    
    public function loadModel($modelName) {
        require_once(MVC_MODELS . strtolower($modelName) . '.php');
    }
    
    public function loadView($viewName, $navbar = true) {
        return new View($viewName, $navbar);
    }
    
    public function loadPlugin($pluginName) {
        require_once(APP_DIR . 'plugins' . DS . strtolower($pluginName) . '.php');
    }
    
    public function loadClass($className) {
        require_once(APP_DIR . 'classes' . DS . strtolower($className) . '.php');
    }
    
    public static function navigate($location) {
        $url = Request::resolveUrl($location);
        header('Location: ' . $url);
    }
}