<?php

class ErrorController extends Controller {
    
    function index() {
        $this->error404();
    }
    
    function error404() {
        echo '<h1>Error 404</h1>';
        echo '<p>El recurso solicitado no existe.</p>';
    }
    
}