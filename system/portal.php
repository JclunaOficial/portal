<?php

// cargar las configuraciones
require_once(APP_DIR . 'settings.php');

final class Portal {
    
    // información básico del framework; NO REMOVER!!! 
    const Product = 'Portal';
    const Version = '2016.05.30.1159';
    const Author  = 'Juan C. Luna H.';
    
    // declaracion de variables de trabajo
    private $controller = CONTROLLER_DEFAULT;
    private $action      = 'index';
    private $url         = '';
    
    public function __construct() {
        // cargar los helpers del sistema
        $this->loadHelpers();
        
        // cargar las clases para la gestion MVC
        require_once(SYS_DIR . 'controller.php');
        require_once(SYS_DIR . 'view.php');
        require_once(SYS_DIR . 'model.php');
    }
    
    public function run() {
        // recuperar los segmentos de la petición web
        $segments = $this->getSegments();
        
        // identificar el controlador, acción y parametros de la petición
        $paramsIndex = $this->getControllerAction($segments);
        
        // validar el controlador (clase) y la acción (función)
        $cf = $this->validateController($paramsIndex);
        
        // ejecutar el controlador/accion
        $obj = new $cf[0];
        die(call_user_func_array(array($obj, $cf[1]), array_slice($segments, $cf[2])));
    }
    
    private function validateController($paramsIndex) {
        $usingError = false;
        
        // verificar que exista la clase
        $controller = UString::toCapitalize($this->controller);
        $cls = $controller;
        if(!class_exists($cls)) {
            // es probable que el controlador tenga el sufijo <Controller>
            $cls = $controller . 'Controller';
            if(!class_exists($cls)) {
                // tampoco existe con el sufijo, usar el controlador de error
                $cls = CONTROLLER_ERROR;
                $this->controller = $cls;
                $this->action = 'index';
                $usingError = true;
            }
        }
                
        // verificar la existencia de la función
        $fnc = $this->action;
        if(!method_exists($cls, $fnc)) {
            // no existe la función, usar el controlador de error
            $cls = CONTROLLER_ERROR;
            $this->controller = $cls;
            $this->action = 'index';
            $usingError = true;
        }
        
        if($usingError) {
            // el controlador o función no localizada
            require_once(MVC_CONTROLLERS . $this->controller . '.php');
            
            $fnc = 'index';
            if(!class_exists($cls)) {
                $cls .= 'Controller';
            }
            $paramsIndex = 2;
        }
        
        return array($cls, $fnc, $paramsIndex);
    }
    
    private function loadHelpers() {
        // los helpers se deben localizar en el folder <helpers> de la aplicación
        $path = APP_DIR . 'helpers' . DS;
        $helpers = array_diff(scandir($path), array('..', '.'));
        foreach($helpers as $helper) {
            if(!is_dir($helper)) {
                // cargar el helper localizado
                require_once($path . $helper);
            }
        }
    }
    
    private function getSegments() {
        // recuperar las referencias de la petición web
        $request_url = Request::getUrl();
        $script_url = Request::getScript();
        
        // identificar la url de trabajo en la petición
        if ($request_url != $script_url) {
            $this->url = trim(preg_replace('/' . str_replace('/', '\/', str_replace('index.php', '', $script_url)) . '/', '', $request_url, 1), '/');
        }
        
        return explode('/', $this->url);
    }
    
    private function findControllerAction($segments, $position) {
        $idx = $position; // identificar el controlador
        if(isset($segments[$idx]) && $segments[$idx] != '') {
            $this->controller = $segments[$idx];
        }
        
        $idx = $position + 1; // identificar la acción
        if(isset($segments[$idx]) && $segments[$idx] != '') {
            $this->action = $segments[$idx];
        } else {
            $this->action = 'index';
        }
        
        if($position == 0) {
            // controlador en folder principal
            $path = MVC_CONTROLLERS . $this->controller . '.php';
        } else {
            // controlador en subfolder
            $path = MVC_CONTROLLERS . $segments[0] . DS . $this->controller . '.php';            
        }
        
        if(file_exists($path)) {
            // cargar el controlador localizado
            require_once($path);
            return true;
        }
        
        // el controlador no existe
        return false;
    }
    
    private function getControllerAction($segments) {
        $offset = 2; // recuperar los segmentos de la petición web
        
        // localizar el controlador en la primer forma: /controller/action/
        if($this->findControllerAction($segments, 0) == false) {
            $offset = 3; // se asume existencia de sección
            
            // localizar el controlador en la segunda forma: /<section>/controller/action/
            if($this->findControllerAction($segments, 1) == false) {
                $offset = 2; // no existe el controlador
                $this->controller = CONTROLLER_ERROR;
                $this->action = 'index';
                require_once(MVC_CONTROLLERS . $this->controller . '.php');
            }
        }
        return $offset;
    }
}