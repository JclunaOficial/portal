<?php

/**
* Controlador para presentar errores comunes
*/
final class ErrorController extends Controller {
    
    function __construct() {
        // no require de login
        $this->setRequireLogin(false);
    }
    
    function index() {
        // el error predeterminado
        $this->error404();
    }
    
    function error404() {
        // presentar el error 404
        $view = $this->loadView('errors|404', false);
        $view->addVar('pageTitle', 'Error 404');
        $view->render();
    }
    
}