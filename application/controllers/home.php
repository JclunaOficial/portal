<?php

final class HomeController extends Controller {
    
    public function index() {
        // cargar la vista principal
        $view = $this->loadView('home' . DS . 'index');
        
        $view->render();
    }
    
}