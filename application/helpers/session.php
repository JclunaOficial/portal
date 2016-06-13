<?php

// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}

/**
 * Gestor de variables de sesión
 */
final class Session {

    /**
     * Recuperar todas las variables en la sesión
     * @return array lista de variables
     */
    public static function getValues() {
        if (!isset($_SESSION)) {
            return array();
        }
        return $_SESSION;
    }

    /**
     * Recupera el valor de una variable de sesión
     * @param string $varName
     * @param string $defaultValue
     * @return mixed 
     * @throws Exception
     */
    public static function getValue($varName, $defaultValue = null) {
        $search = UString::toUpper($varName);
        if (strlen($search) == 0) {
            throw new Exception('The session key is required.');
        }

        $sessionValues = self::getValues();
        if (array_key_exists(PORTAL_SESSION . $search, $sessionValues)) {
            return $sessionValues[PORTAL_SESSION . $search];
        }
        return $defaultValue;
    }

    /**
     * Asigna el valor de una variable de sesión
     * @param type $varName
     * @param type $value
     */
    public static function setValue($varName, $value) {
        $_SESSION[UString::toUpper(PORTAL_SESSION . $varName)] = $value;
    }

    /**
     * Remueve una variable de la sesión
     */
    public static function remove($key) {
        unset($_SESSION[UString::toUpper(PORTAL_SESSION . $key)]);
    }

    /**
     * Elimina todas las variables de la sesión
     */
    public static function destroy() {
        if (PORTAL_SESSION == '') {
            // destruir todas las variables           
            session_unset();
            session_destroy();
        } else {
            // localizar y remover las variables especificas del portal
            $values = self::getValues();
            foreach ($values as $key => $value) {
                if (UString::startsWith($key, PORTAL_SESSION)) {
                    // quitar la variable localizada
                    unset($_SESSION[$key]);
                }
            }
        }
    }

}
