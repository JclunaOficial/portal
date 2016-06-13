<?php

// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}

/**
 * Funciones para manejar Strings
 */
final class UString {

    /**
     * Inicializar y truncar un string
     * @param string $value valor a procesar
     * @param int $length longitud a truncar
     * @return string valor procesado
     */
    public static function toEmpty($value, $length = 0) {
        $result = ''; // inicializar la cadena de salida

        if (isset($value) && strlen($value) > 0) {
            // quitar espacios al inicio y al final de la cadena
            $result = trim($value);
        }

        if ($length > 0 && strlen($result) > $length) {
            // truncar la cadena a la longitud especificada
            $result = substr($result, 0, $length);
        }

        return $result; // regresar cadena de salida.
    }

    /**
     * Inicializar, convertir a máyusculas y truncar un string
     * @param string $value valor a procesar
     * @param int $length longitud a truncar
     * @return string valor procesado
     */
    public static function toUpper($value, $length = 0) {
        return strtoupper(self::toEmpty($value, $length));
    }

    /**
     * Inicializar, convertir a mínusculas y truncar un string
     * @param string $value valor a procesar
     * @param int $length longitud a truncar
     * @return string valor procesado
     */
    public static function toLower($value, $length = 0) {
        return strtolower(self::toEmpty($value, $length));
    }

    /**
     * Inicializar, capitalizar y truncar un string
     * @param string $value valor a procesar
     * @param int $length longitud a truncar
     * @return string valor procesado
     */
    public static function toCapitalize($value, $length = 0) {
        return ucfirst(self::toLower($value, $length));
    }

    /**
     * Encriptar un valor usando el algoritmo Blowfish
     * @param string $value valor a encriptar
     * @param int $rounds ciclos de encriptación
     * @return string valor encriptado
     */
    public static function encrypt($value, $rounds = 7) {
        $salt = "";
        $salt_chars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
        for ($i = 0; $i < 22; $i++) {
            $salt .= $salt_chars[array_rand($salt_chars)];
        }
        return crypt($value, sprintf('$2a$%02d$', $rounds) . $salt);
    }

    /**
     * Verificar un valor contra otro encriptado con el argoritmo Blowfish
     * @param string $value valor en texto plano
     * @param string $encrypted valor encriptado
     * @return boolean
     */
    public static function verify($value, $encrypted) {
        return (crypt($value, $encrypted) == $encrypted);
    }

    /**
     * Determina si el string inicia con el valor especificado.
     * @param string $value valor a evaluar
     * @param string $search valor a buscar
     * @return boolean
     */
    public static function startsWith($value, $search) {
        return $search === "" || strrpos($value, $search, -strlen($value)) !== false;
    }

    /**
     * Determina si el string finaliza con el valor especificado
     * @param string $value valor a evaluar
     * @param string $search valor a buscar
     * @return boolean
     */
    public static function endsWith($value, $search) {
        return $search === "" || (($temp = strlen($value) - strlen($search)) >= 0 && strpos($value, $search, $temp) !== false);
    }

    /**
     * Recuperar un string con la fecha especificada en formato aaaa-mm-dd 
     * @param DateTime $date objeto DateTime con la fecha a formatear
     * @return string
     */
    public static function formatDate($date = null) {
        if ($date === null) {
            return '';
        }
        return $date->format('Y-m-d');
    }

    /**
     * Recuperar un string con la fecha y hora especificada en formato aaaa-mm-dd hh:mm<:ss>
     * @param DateTime $date objeto DateTime con la fecha y hora a formatear
     * @param boolean $seconds verdadero para incluir los segundos en el formato
     * @return string
     */
    public static function formatDateTime($date = null, $seconds = false) {
        if ($date === null) {
            return '';
        }
        if ($seconds == true) {
            return $date->format('Y-m-d H:i:s');
        } else {
            return $date->format('Y-m-d H:i');
        }
    }

    /**
     * Recuperar un string con la fecha y hora especificada en formato ISO aaaa-mm-ddThh:mm:ss
     * @param DateTime $date objeto DateTime con la fecha y hora a formatear
     * @return string
     */
    public static function formatDateISO($date = null) {
        if ($date === null) {
            return '';
        }
        return $date->format('Y-m-d\TH:i:s');
    }

    /**
     * Recupera un string con la fecha y hora actual en formato ISO aaaa-mm-ddThh:mm:ss
     * @return string
     */
    public static function formatNowISO() {
        return self::formatDateISO(new DateTime());
    }

    /**
     * Recupera un string con la fecha actual en formato aaaa-mm-dd
     * @return string
     */
    public static function formatNow() {
        return self::formatDate(new DateTime());
    }

    /**
     * Recupera un string con la fecha y hora actual en formato aaaa-mm-dd hh:mm<:ss>
     * @param boolean $seconds verdadero para incluir los segundos en el formato
     * @return string
     */
    public static function formatNowDateTime($seconds = false) {
        return self::formatDateTime(new DateTime(), $seconds);
    }

    /**
     * Recupera un string con la hora actual en formato hh:mm<:ss>
     * @param boolean $seconds verdadero para incluir los segundos en el formato
     * @return string
     */
    public static function formatNowTime($seconds = false) {
        $date = new DateTime();
        if ($seconds == true) {
            return $date->format('H:i:s');
        } else {
            return $date->format('H:i');
        }
    }

    /**
     * Formatear un número con los separadores necesarios
     * @param int $value número a formatear
     * @param boolean $cero verdadero para regresar un guión en lugar de cero
     * @return string número formateado
     */
    public static function formatNumber($value, $cero = true) {
        if (!$cero && $value == 0) {
            return '-';
        } else {
            return number_format($value);
        }
    }

    /**
     * Reemplaza el caracter pipe '|' por el separador de directorios 'DS'
     * @param string $value valor a procesar
     * @return string cadena con el caracter reemplazado
     */
    public static function replacePipe($value) {
        return str_replace('|', DS, $value);
    }

}
