<?php

// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}

/**
 * Clase de ayuda para la declaración y gestión de enumeraciones
 */
abstract class Enum {

    private static $cache = NULL;

    /**
     * Determina si el nombre existe y es valido dentro de la enumeración
     * @param string $name nombre de la opción a validar
     * @param boolean $strict buscar el nombre exacto (case sensitive)
     * @return boolean verdadero si la opción existe en la enumeración
     */
    public static function isValidName($name, $strict = false) {
        $constants = self::getConstants();
        if ($strict) {
            // buscar el nombre exacto (case sensitive)
            return array_key_exists($name, $constants);
        }

        // buscar el nombre invariablemente (case insensitive)
        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    /**
     * Determina si el valor existe y es valido dentro de la enumeración
     * @param mixed $value valor de la opción a validar
     * @param boolean $strict buscar el valor exacto (case sensitive)
     * @return boolean verdadero si el valor existe en la enumeración
     */
    public static function isValidValue($value, $strict = false) {
        $values = array_values(self::getConstants());
        return in_array($value, $values, $strict);
    }

    private static function getConstants() {
        if (self::$cache == NULL) {
            // inicializar el cache
            self::$cache = Array();
        }

        // código de reflexion del código
        $class = get_called_class();
        if (!array_key_exists($class, self::$cache)) {
            $reflect = new ReflectionClass($class);
            self::$cache[$class] = $reflect->getConstants();
        }

        // regresar los valores
        return self::$cache[$class];
    }

}
