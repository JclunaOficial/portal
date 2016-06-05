<?php
if(!defined('ROOT_DIR')) { die('Acceso Denegado'); }

/**
* Controlador para termina la sesión de usuario
*/
final class LogoutController extends Controller {
    
    function __construct() {
        // no require de login
        $this->setRequireLogin(false);
    }
    
    function index() {
        // destruir la sesión
        Session::destroy();
        
        // navegar a la página predeterminada
        self::navigate(CONTROLLER_DEFAULT);
    }
    
}