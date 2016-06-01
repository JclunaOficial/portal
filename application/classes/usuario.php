<?php

/**
* Información básica de un usuario
*/
final class Usuario {
    
    // definición de constantes para la clase
    const SIN_ASIGNAR = 0;
    const TIPO_USUARIO = 1;
    const TIPO_ADMIN = 2;
    const ESTATUS_ACTIVO = 1;
    const ESTATUS_INACTIVO = 2;
    
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
        $this->tipo = self::SIN_ASIGNAR;
        $this->cuenta = '';
        $this->correo = '';
        $this->estatus = self::SIN_ASIGNAR;
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
        if($tipo < self::SIN_ASIGNAR || $tipo > self::TIPO_ADMIN) {
            $this->tipo = self::SIN_ASIGNAR;
        } else {
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
        if($estatus < self::SIN_ASIGNAR || $estatus > self::ESTATUS_INACTIVO) {
            $this->estatus = self::SIN_ASIGNAR;
        } else {
            $this->estatus = $estatus;
        }
    }
}