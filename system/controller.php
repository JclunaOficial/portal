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
}