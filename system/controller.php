<?php

// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}

/**
 * Clase base para un controlador
 */
class Controller {

    private $require_login = true;

    /**
     * Determina si el controlador require sesión de usuario o no
     * @return boolean verdadero si el login es requerido
     */
    public function getLoginRequired() {
        return $this->require_login;
    }

    /**
     * Especifica si el controlador require sesión de usuario
     * @param boolean $require valor para especificar si es requerido o no
     */
    public function setLoginRequired($require) {
        $this->require_login = $require;
    }

    /**
     * Cargar un modelo MVC
     * @param string $modelName nombre del modelo a cargar
     */
    public function loadModel($modelName) {
        require_once(UString::replacePipe(MVC_MODELS . strtolower($modelName) . '.php'));
    }

    /**
     * Cargar una vista MVC
     * @param string $viewName nombre de la vista a cargar
     * @param boolean $showNavbar verdadero para mostrar la barra de navegación
     * @return \View una instancia que hereda la clase View (vista MVC)
     */
    public function loadView($viewName, $showNavbar = true) {
        return new View(UString::replacePipe($viewName), $showNavbar);
    }

    /**
     * Navegar hacia un controlador en especifico
     * @param string $controllerName
     */
    public static function navigate($controllerName) {
        $url = Request::resolveUrl($controllerName);
        header('Location: ' . $url);
    }

}
