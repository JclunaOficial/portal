<?php

// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}

/**
 * Controlador para Logout
 */
final class LogoutController extends Controller {

    /**
     * Crear una instancia del tipo LogoutController
     */
    function __construct() {
        // este controlador no requiere del login
        $this->setLoginRequired(false);
    }

    /**
     * Acción principal del controlador
     * @return void
     */
    public function index() {
        // destruir la sesión del usuario y regresar a la pagina principal
        Session::destroy();
        self::navigate(CONTROLLER_DEFAULT);
    }

}
