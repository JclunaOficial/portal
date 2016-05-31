<?php

final class UString {
    
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
    
    public static function toUpper($value, $length = 0) {
        return strtoupper(self::toEmpty($value, $length));
    }
    
    public static function toLower($value, $length = 0) {
        return strtolower(self::toEmpty($value, $length));
    }
    
    public static function toCapitalize($value, $length = 0) {
        return ucfirst(self::toLower($value, $length));
    }
    
    public static function startsWith($value, $search) {
        return $search === "" || strrpos($value, $search, -strlen($value)) !== false;
    }
    
    public static function endsWith($value, $search) {
        return $search === "" || (($temp = strlen($value) - strlen($search)) >= 0 && strpos($value, $search, $temp) !== false);
    }

    public static function formatDate($date = null) {
        if ($date === null) {
            return '';
        }
        return $date->format('Y-m-d');
    }

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

    public static function formatDateISO($date = null) {
        if ($date === null) {
            return '';
        }
        return $date->format('Y-m-d\TH:i:s');
    }

    public static function formatNowISO() {
        return self::formatDateISO(new DateTime());
    }

    public static function formatNow() {
        return self::formatDate(new DateTime());
    }

    public static function formatNowTime($seconds = false) {
        return self::formatDateTime(new DateTime(), $seconds);
    }
}