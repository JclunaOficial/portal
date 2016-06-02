<?php

/**
* Funciones para manejar Strings
*/
final class UString {
    
    /**
    * Inicializa un string con posibilidad de truncarla.
    */
    public static function toEmpty($value, $length = 0) {
        $result = ''; // inicializar la cadena de salida
        
        if(isset($value) && strlen($value) > 0) {
            // quitar espacios al inicio y al final de la cadena
            $result = trim($value);
        }
        
        if($length > 0 && strlen($result) > $length) {
            // truncar la cadena a la longitud especificada
            $result = substr($result, 0, $length);
        }
        
        return $result; // regresar cadena de salida.
    }
    
    /**
    * Inicializa un string, lo convierte a mayúsculas con posibilidad de truncarla.
    */
    public static function toUpper($value, $length = 0) {
        return strtoupper(self::toEmpty($value, $length));
    }
    
    /**
    * Inicializa un string, lo convierte a minúsculas con posibilidad de truncarla.
    */
    public static function toLower($value, $length = 0) {
        return strtolower(self::toEmpty($value, $length));
    }
    
    /**
    * Inicializa un string, la capitaliza con posibilidad de truncarla.
    */
    public static function toCapitalize($value, $length = 0) {
        return ucfirst(self::toLower($value, $length));
    }
    
    /**
    * Determina si el string inicia con el valor especificado.
    */
    public static function startsWith($value, $search) {
        return $search === "" || strrpos($value, $search, -strlen($value)) !== false;
    }
    
    /**
    * Determina si el string finaliza con el valor especificado.
    */
    public static function endsWith($value, $search) {
        return $search === "" || (($temp = strlen($value) - strlen($search)) >= 0 && strpos($value, $search, $temp) !== false);
    }
    
    /**
    * Convierte un objeto DateTime en un string con formato aaaa-mm-dd 
    */
    public static function formatDate($date = null) {
        if ($date === null) {
            return '';
        }
        return $date->format('Y-m-d');
    }
    
    /**
    * Convierte un objeto DateTime en un string con formato aaaa-mm-dd hh:mm<:ss>
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
    * Convierte un objeto DateTime en un string con formato ISO aaaa-mm-ddThh:mm:ss
    */
    public static function formatDateISO($date = null) {
        if ($date === null) {
            return '';
        }
        return $date->format('Y-m-d\TH:i:s');
    }
    
    /**
    * Recupera un string con la fecha actual con formato ISO aaaa-mm-ddThh:mm:ss
    */
    public static function formatNowISO() {
        return self::formatDateISO(new DateTime());
    }
    
    /**
    * Recupera un string con la fecha actual con formato aaaa-mm-dd
    */
    public static function formatNow() {
        return self::formatDate(new DateTime());
    }
    
    /**
    * Recupera un string con la fecha actual con formato aaaa-mm-dd hh:mm<:ss> 
    */
    public static function formatNowDateTime($seconds = false) {
        return self::formatDateTime(new DateTime(), $seconds);
    }
    
    /**
    * Recupera un string con la hora actual con formato hh:mm<:ss>
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
    * Reemplaza el pipe '|' por el separador de directorios 'DS'
    */
    public static function replacePipe($value) {
        return str_replace('|', DS, $value);
    }
}