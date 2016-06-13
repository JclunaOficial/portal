<?php

// antes de cualquier cosa se inicia la sesión
session_start();

// declaración corta para el separador de directorios
define('DS', DIRECTORY_SEPARATOR);

// declarar la ruta raíz para la aplicación
define('ROOT_DIR', realpath(dirname(__FILE__)) . DS);

// usando la ruta raíz se define el folder de sistema y de aplicación
// por defecto son "system" y "application" respectivamente, pero si
// es necesario se puede cambiar el nombre y aquí se cambian los valores.
define('SYS_DIR', ROOT_DIR . 'system' . DS);
define('APP_DIR', ROOT_DIR . 'application' . DS);

// cargar el módulo principal del framework
require_once(SYS_DIR . 'portal.php');
$portal = new Portal();

// ejecutar la aplicación
$portal->run();
