<?php

/**
* Gestor de solicitudes HTTP
*/
final class Request {
    
    /**
    * Recupera la URL de la página solicitada en la petición actual
    */
    public static function getUrl() {
        return UString::toEmpty(filter_input(INPUT_SERVER, 'REQUEST_URI'));
    }
    
    /**
    * Recupera el nombre del script solicitado en la petición actual
    */
    public static function getScript() {
        return UString::toEmpty(filter_input(INPUT_SERVER, 'PHP_SELF'));
    }
    
    /**
    * Determina si la petición actual es realizada como un POST
    */    
    public static function isPostback() {
        $method = UString::toUpper(self::getServer('REQUEST_METHOD', ''));
        return ($method == 'POST');
    }
    
    /**
    * Recupera la lista de todos los campos del formulario recibido
    */
    public static function getFormValues() {
        $result = filter_input_array(INPUT_POST);
        if (!isset($result)) {
            $result = array();
        }
        return $result;
    }
    
    /**
    * Recupera el valor de un campo del formulario recibido
    */
    public static function getForm($key, $default = null) {
        $formValues = self::getFormValues();
        if (array_key_exists($key, $formValues)) {
            return UString::toEmpty($formValues[$key]);
        } else {
            return $default;
        }
    }
    
    /**
    * Recupera la lista de todos las variables del servidor
    */
    public static function getServerValues() {
        $result = filter_input_array(INPUT_SERVER);
        if (!isset($result)) {
            $result = array();
        }
        return $result;
    }
    
    /**
    * Recupera el valor de una variable del servidor
    */
    public static function getServer($key, $default = null) {
        $serverValues = self::getServerValues();
        if (array_key_exists($key, $serverValues)) {
            return UString::toEmpty($serverValues[$key]);
        } else {
            return $default;
        }
    }
    
    /**
    * Recupera la URL del servidor web (host)
    */
    public static function getHostUrl() {
        $server = self::getServer('SERVER_NAME', 'localhost');
        $port = self::getServer('SERVER_PORT', '80');
        $https = UString::toUpper(self::getServer('HTTPS', 'off'));
        if($https == 'ON') {
            $host_url = 'https://'.$server;
            if($port != '443') {
                $host_url .= ':' . $port;
            }
        } else {
            if($port == '443') {
                $host_url = 'https://'.$server;
            } else {
                $host_url = 'http://'.$server;
                if($port != '80') {
                    $host_url .= ':' . $port;
                }
            }
        }
        
        return $host_url . '/';
    }
    
    /**
    * Recupera la URL con el acceso al servidor y la aplicación base
    */
    public static function resolveUrl($url) {
        return self::getHostUrl() . BASE_URL . $url;
    }
    
}
