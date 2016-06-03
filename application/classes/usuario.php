<?php

/** Valores para determinar el tipo de usuario */
abstract class UsuarioTipo extends Enum {
    /** El tipo de usuario no esta asígnado */
    const SinAsignar = 0;
    
    /** El usuario es un simple mortal */
    const Usuario = 1;
    
    /** El usuario es un administrador */
    const Administrador = 128;
}

/** Valores para determina el estatus del usuario */
abstract class UsuarioEstatus extends Enum {
    /** El estatus del usuario no esta asignado */
    const SinAsignar = 0;
    
    /** El usuario esta activo */
    const Activo = 1;
    
    /** El usuario no esta activo */
    const Inactivo = 2;
}

/**
* Información básica de un usuario
*/
final class Usuario {
    
    // declaración de atributos
    private $id;
    private $tipo;
    private $cuenta;
    private $nombre;
    private $correo;
    private $estatus;
    
    public function __construct() {
        // inicializar los atributos
        $this->id = 0;
        $this->tipo = UsuarioTipo::SinAsignar;
        $this->cuenta = '';
        $this->correo = '';
        $this->estatus = UsuarioEstatus::SinAsignar;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getTipo() {
        return $this->tipo;
    }
    
    public function setTipo($tipo) {
        $this->tipo = UsuarioTipo::SinAsignar;
        if(UsuarioTipo::isValidValue($tipo)) {
            $this->tipo = $tipo;
        }
    }
    
    public function getCuenta() {
        return $this->cuenta;
    }
    
    public function setCuenta($cuenta) {
        $this->cuenta = UString::toEmpty($cuenta, 16);
    }
    
    public function getNombre() {
        return $this->nombre;
    }
    
    public function setNombre($nombre) {
        $this->nombre = UString::toEmpty($nombre, 150);
    }
    
    public function getCorreo() {
        return $this->correo;
    }
    
    public function setCorreo($correo) {
        $this->correo = UString::toEmpty($correo, 128);
    }
    
    public function getEstatus() {
        return $this->estatus;
    }
    
    public function setEstatus($estatus) {
        $this->estatus = UsuarioEstatus::SinAsignar;
        if(UsuarioEstatus::isValidValue($estatus)) {
            $this->estatus = $estatus;
        }
    }
}