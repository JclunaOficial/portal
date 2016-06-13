<?php

// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}

/**
 * Gestor de las peticiones web
 */
final class Request {

    /**
     * Recupera la URL de la página solicitada en la petición actual
     * @return string url del recurso solicitado
     */
    public static function getUrl() {
        return UString::toEmpty(filter_input(INPUT_SERVER, 'REQUEST_URI'));
    }

    /**
     * Recupera el nombre del script solicitado en la petición actual
     * @return string nombre del script (.php)
     */
    public static function getScript() {
        return UString::toEmpty(filter_input(INPUT_SERVER, 'PHP_SELF'));
    }

    /**
     * Determinar si la petición actual es realizada como un POST
     * @return boolean verdadero si la petición es con un POST
     */
    public static function isPostback() {
        $method = UString::toUpper(self::getServer('REQUEST_METHOD', ''));
        return ($method == 'POST');
    }

    /**
     * Recuperar los elementos del formulario recibido
     * @return array de elemento-valor
     */
    public static function getFormValues() {
        $result = filter_input_array(INPUT_POST);
        if (!isset($result)) {
            $result = array();
        }
        return $result;
    }

    /**
     * Recupera el valor de un elemento del formulario
     * @param string $elementName nombre del elemento
     * @param mixed $default valor por defecto si no existe el elemento
     * @return mixed valor del elemento localizado
     */
    public static function getForm($elementName, $default = null) {
        $formValues = self::getFormValues();
        if (array_key_exists($elementName, $formValues)) {
            return UString::toEmpty($formValues[$elementName]);
        } else {
            return $default;
        }
    }

    /**
     * Recupera las variables del servidor
     * @return array de variable-valor
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
     * @param string $varName nombre de la variable
     * @param mixed $default valor por defecto si no existe la variable
     * @return mixed valor de la variable localizada
     */
    public static function getServer($varName, $default = null) {
        $serverValues = self::getServerValues();
        if (array_key_exists($varName, $serverValues)) {
            return UString::toEmpty($serverValues[$varName]);
        } else {
            return $default;
        }
    }

    /**
     * Recupera la URL del servidor web (host)
     * @return string URL del servidor web (ej. http://localhost:8088/)
     */
    public static function getHostUrl() {
        $server = self::getServer('SERVER_NAME', 'localhost');
        $port = self::getServer('SERVER_PORT', '80');
        $https = UString::toUpper(self::getServer('HTTPS', 'off'));
        if ($https == 'ON') {
            $host_url = 'https://' . $server;
            if ($port != '443') {
                $host_url .= ':' . $port;
            }
        } else {
            if ($port == '443') {
                $host_url = 'https://' . $server;
            } else {
                $host_url = 'http://' . $server;
                if ($port != '80') {
                    $host_url .= ':' . $port;
                }
            }
        }

        return $host_url . '/';
    }

    /**
     * resolver un recurso con la URL de servidor web y URL base
     * @param string $url porción de la url a resulver (ej. auth/login)
     * @return type
     */
    public static function resolveUrl($url) {
        return self::getHostUrl() . BASE_URL . $url;
    }

}
