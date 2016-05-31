<?php

final class LoginController extends Controller {
    
    public function index() {
        // verificar si hay sesión de usuario iniciada
        if(Session::get(LOGIN_READY, false)){
            // navegar a la página predeterminada
            self::navigate(CONTROLLER_DEFAULT);
            return; // termina proceso
        }
        
        $mensaje = '';
        if(Request::isPostback()) {
            // obtener información del usuario
        }
        
        // presentar la vista para el login
        $view = $this->loadView('auth|login', false);
        $view->addVar('pageTitle', 'Control de Acceso');
        $view->addVar('mensaje', $mensaje);
        
        $this->agregarComponentes($view);
        $view->render();
    }
    
    private function agregarComponentes($view) {
        // agregar las hojas de estilo para la vista
        $view->addStyle(Request::resolveUrl('theme/css/login.css'));
        
        // agregar los scripts para la vista
        $view->addScript(Request::resolveUrl('theme/js/jquery.backstretch.min.js'));
        
        // agregar los fragmentos de código a incluir
        $view->addInclude(MVC_VIEWS . 'auth|inc_login_script.php');
    }
}