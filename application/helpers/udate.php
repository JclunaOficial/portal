<?php

// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}

final class UDate {

    /**
     * Valor de la fecha inicial (valor mínimo en el sistema)
     */
    const START_DATE = '1900-01-01 00:00:00.000000';

    /**
     * Recuperar un objeto DateTime con la fecha inicial
     * @return \DateTime
     */
    public static function startDate() {
        return new DateTime(self::START_DATE);
    }

    /**
     * Recuperar un string con formato hh:mm[:ss] desde un objeto DateTime
     * @param DateTime $date objeto con la hora a formatear
     * @param boolean $withSeconds incluir los segundos
     * @return string
     */
    public static function formatTime($date = null, $withSeconds = true) {
        if (!isset($date)) {
            $date = new DateTime();
        }

        if ($withSeconds == true) {
            // dar formato a la hora con segundos
            return $date->format('H:i:s');
        }

        // dar formato a la hora sin segundos
        return $date->format('H:i');
    }

    /**
     * Recuperar un string con formato yyyy-mm-dd [hh:mm[:ss]] desde un objeto DateTime
     * @param DateTime $date objeto con la fecha y hora a formatear
     * @param boolean $withHour incluir la hora
     * @param boolean $withSeconds incluir los segundos
     * @return string
     */
    public static function format($date, $withHour = false, $withSeconds = true) {
        if (!isset($date) || $date === null || $date <= self::startDate()) {
            return ''; // no hay fecha para dar formato
        }

        // dar formato a la fecha
        $result = $date->format('Y-m-d');
        if ($withHour == true) {
            // dar formato a la hora
            $result .= ' ' . self::formatTime($date, $withSeconds);
        }

        // regresar la fecha procesada
        return $result;
    }

    /**
     * Recuperar un string con formato hh:mm[:ss] usando la fecha actual
     * @param boolean $withHour incluir la hora
     * @param boolean $withSeconds incluir los segundos
     * @return string
     */
    public static function formatNow($withHour = false, $withSeconds = true) {
        return self::format(new DateTime(), $withHour, $withSeconds);
    }

    /**
     * Recuperar un string con formato yyyy-mm-ddThh:mm:ss desde un objeto DateTime
     * @param DateTime $date objeto con la fecha y hora a formatear
     * @return string
     */
    public static function formatIso($date) {
        return str_replace(' ', 'T', self::format($date, true));
    }

    /**
     * Recuperar un string con formato yyyy-mm-ddThh:mm:ss usando la fecha actual
     * @return string
     */
    public static function formatNowIso() {
        return self::formatIso(new DateTime());
    }

}
