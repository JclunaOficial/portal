<?php

final class LogoutController extends Controller {
    
    function index() {
        // destruir la sesión
        Session::destroy();
        
        // navegar a la página predeterminada
        self::navigate('');
    }
    
}