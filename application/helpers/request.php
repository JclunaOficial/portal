<?php

final class Request {
    
    public static function getUrl() {
        return UString::toEmpty(filter_input(INPUT_SERVER, 'REQUEST_URI'));
    }
    
    public static function getScript() {
        return UString::toEmpty(filter_input(INPUT_SERVER, 'PHP_SELF'));
    }

    public static function isPostback() {
        $method = UString::toUpper(self::getServer('REQUEST_METHOD', ''));
        return ($method == 'POST');
    }

    public static function getFormValues() {
        $result = filter_input_array(INPUT_POST);
        if (!isset($result)) {
            $result = array();
        }
        return $result;
    }

    public static function getForm($key, $default = null) {
        $formValues = self::getFormValues();
        if (array_key_exists($key, $formValues)) {
            return UString::toEmpty($formValues[$key]);
        } else {
            return $default;
        }
    }

    public static function getServerValues() {
        $result = filter_input_array(INPUT_SERVER);
        if (!isset($result)) {
            $result = array();
        }
        return $result;
    }

    public static function getServer($key, $default = null) {
        $serverValues = self::getServerValues();
        if (array_key_exists($key, $serverValues)) {
            return UString::toEmpty($serverValues[$key]);
        } else {
            return $default;
        }
    }

    public static function resolveUrl($url) {
        return BASE_URL . $url;
    }
    
}
