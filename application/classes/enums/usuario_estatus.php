<?php

/** Valores para determina el estatus del usuario */
abstract class UsuarioEstatus extends Enum {
    /** El estatus del usuario no esta asignado */
    const SinAsignar = 0;
    
    /** El usuario esta activo */
    const Activo = 1;
    
    /** El usuario no esta activo */
    const Inactivo = 2;
}
