<?php

/**
* Clase base para un controlador
*/
class Controller {
    
    private $require_login = true;
    
    /**
    * Determina si el controlador require sesión de usuario
    */
    public function getRequireLogin() {
        return $this->require_login;
    }
    
    /**
    * Especifica si el controlador require sesión de usuario
    */
    public function setRequireLogin($require) {
        $this->require_login = $require;
    }
    
    /**
    * Carga un modelo localizado en la ruta ~/application/models/
    */
    public function loadModel($model) {
        require_once(UString::replacePipe(MVC_MODELS . strtolower($model) . '.php'));
    }
    
    /**
    * Carga una vista localizada en la ruta ~/application/views/
    */
    public function loadView($view, $navbar = true) {
        return new View(UString::replacePipe($view), $navbar);
    }
    
    /**
    * Carga una clase localizada en la ruta ~/application/classes/
    */
    public function loadClass($class) {
        require_once(UString::replacePipe(APP_DIR . 'classes|' . strtolower($class) . '.php'));
    }
    
    /**
    * Navegar al controlador especificado
    */
    public static function navigate($location) {
        $url = Request::resolveUrl($location);
        header('Location: ' . $url);
    }
}