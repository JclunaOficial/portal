<?php

// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}

/**
 * Controlador para Home
 */
final class HomeController extends Controller {

    /**
     * Acción principal del controlador
     * @return void
     */
    public function index() {
        // cargar la vista principal
        $view = $this->loadView('home|tablero');
        $view->addVar('pageTitle', 'Home');

        // presentar la vista
        $view->render();
    }

}
