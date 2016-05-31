<?php

/**
* Gestor de variables de sesión
*/
final class Session {
    
    /**
    * Recuperar la lista de todas las variables en la sesión
    */
    public static function getValues() {
        if (!isset($_SESSION)) {
            return array();
        }
        return $_SESSION;
    }
    
    /**
    * Recupera el valor de una variable de sesión
    */
    public static function get($key, $default = null) {
        $search = UString::toUpper($key);
        if (strlen($search) == 0) {
            throw new Exception('The session key is required.');
        }

        $sessionValues = self::getValues();
        if (array_key_exists($search, $sessionValues)) {
            return $sessionValues[$search];
        }
        return $default;
    }
    
    /**
    * Asigna el valor de una variable de sesión
    */
    public static function set($key, $value) {
        $_SESSION[UString::toUpper($key)] = $value;
    }
    
    /**
    * Remueve una variable de la sesión
    */
    public static function remove($key) {
        unset($_SESSION[UString::toUpper($key)]);
    }
    
    /**
    * Elimina todas las variables de la sesión
    */
    public static function destroy() {
        session_unset();
        session_destroy();
    }

}
