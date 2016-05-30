<?php

final class Session {

    public static function getValues() {
        if (!isset($_SESSION)) {
            return array();
        }
        return $_SESSION;
    }

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

    public static function set($key, $value) {
        $_SESSION[UString::toUpper($key)] = $value;
    }

    public static function remove($key) {
        unset($_SESSION[UString::toUpper($key)]);
    }

    public static function destroy() {
        session_unset();
        session_destroy();
    }

}
