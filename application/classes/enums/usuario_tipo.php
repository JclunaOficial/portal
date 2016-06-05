<?php
if(!defined('ROOT_DIR')) { die('Acceso Denegado'); }

/** Valores para determinar el tipo de usuario */
abstract class UsuarioTipo extends Enum {
    /** El tipo de usuario no esta asígnado */
    const SinAsignar = 0;
    
    /** El usuario es un simple mortal */
    const Usuario = 1;
    
    /** El usuario es un administrador */
    const Administrador = 128;
}
