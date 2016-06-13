<?php

// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}

/* -- CONFIGURACIÓN GENERAL -- */

// url base para el flujo de navegación del sistema
define('BASE_URL', 'portal/');

// controlador a cargar por defecto
define('CONTROLLER_DEFAULT', 'home');

// controlador a cargar para manejar los errores
define('CONTROLLER_ERROR', 'error');

// nombre del tema a utilizar el la UI del sistema
define('DEFAULT_THEME_NAME', 'default');

// forma de presentar la barra de navegación
define('DEFAULT_THEME_NAVBAR', 'default');

// zona horaria predeterminada
define('DEFAULT_TIME_ZONE', 'America/Mexico_City');

/* -- CONFIGURACIÓN DEL PORTAL -- */

// titulo que sera presentado en el portal
define('PORTAL_TITLE', 'Portal');

// prefijo para las variables de sesión propias 
// del protal (en caso de ser un servidor compartido)
define('PORTAL_SESSION', 'PS_');

// nombre de la aplicación que soporta este portal
define('PORTAL_NAME', 'Portal');

// versión de la aplicación que soporta este portal
define('PORTAL_VERSION', '0.1-dummy');

// descripción de los derechos reservados para la 
// aplicación que soporta este portal
define('PORTAL_COPYRIGHT', '&copy; 2016 - Portal, Framework MVC.');

/* -- CONFIGURACIÓN DE ACCESO A LA DB -- */

// nombre dinamico del servidor (DSN): equipo y esquema
define('DB_DSN', 'mysql:host=localhost;dbname=portal;');

// nombre del usuario con privilegios al esquema
define('DB_USR', 'root');

// contraseña de seguridad del usuario
define('DB_PWD', '');
