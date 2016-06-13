<?php

// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}

/**
 * Gestor de excepción especifica del sistema
 */
final class PortalException extends Exception {
    
}
