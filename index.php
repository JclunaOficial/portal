<?php

// antes de cualquier cosa se inicia la sesión
session_start();

// identificar y mantener la ruta raíz
define('DS', DIRECTORY_SEPARATOR); // separador de directorio, segun el sistema operativo
define('ROOT_DIR', realpath(dirname(__FILE__)) . DS); // ruta raíz para la aplicación

// usando la ruta raíz se define el folder de sistema y de aplicación
// por defecto son "system" y "application" respectivamente, pero si 
// es necesario se puede cambiar el nombre y aquí se cambian los valores.
define('SYS_DIR', ROOT_DIR . 'system' . DS);        // ruta de sistema
define('APP_DIR', ROOT_DIR . 'application' . DS);   // ruta de aplicación

// cargar el módulo principal
require_once(SYS_DIR . 'portal.php');
$portal = new Portal(); // crear objeto de trabajo

$host = Request::getHostUrl();
//var_dump(Request::getServerValues());

// iniciar la ejecución del sistema
$portal->run();