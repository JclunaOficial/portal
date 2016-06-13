<?php

// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}

/**
 * Controlador para Error
 */
final class ErrorController extends Controller {

    /**
     * Crear una instancia del tipo ErrorController
     */
    function __construct() {
        // este controlador no requiere del login (evitar un loop infinito)
        $this->setLoginRequired(false);
    }

    /**
     * Acción principal del controlador
     * @return void
     */
    public function index() {
        // el error predeterminado
        $this->error404();
    }

    private function error404() {
        // presentar el error 404
        $view = $this->loadView('errors|404', false);
        $view->addVar('pageTitle', 'Error 404');
        $view->render();
    }

}
