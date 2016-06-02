<?php

/**
* Controlador Home predeterminado
*/
final class HomeController extends Controller {
    
    public function index() {
        // cargar la vista principal
        $view = $this->loadView('home|index');
        $view->addVar('pageTitle', 'Home');
        
        $view->render();
    }
    
}