<?php
if(!defined('ROOT_DIR')) { die('Acceso Denegado'); }

// incluir la enumeraciones
require_once(UString::replacePipe('enums|usuario_tipo.php'));
require_once(UString::replacePipe('enums|usuario_estatus.php'));

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
    
    /** recuperar el ID del usuario */
    public function getId() {
        return $this->id;
    }
    
    /** asignar el ID del usuario */
    public function setId($id) {
        $this->id = $id;
    }
    
    /** recuperar el tipo de usuario */
    public function getTipo() {
        return $this->tipo;
    }
    
    /** asignar el tipo de usuario */
    public function setTipo($tipo) {
        $this->tipo = UsuarioTipo::SinAsignar;
        if(UsuarioTipo::isValidValue($tipo)) {
            $this->tipo = $tipo;
        }
    }
    
    /** recuperar la cuenta del usuario */
    public function getCuenta() {
        return $this->cuenta;
    }
    
    /** asignar la cuenta del usuario */
    public function setCuenta($cuenta) {
        $this->cuenta = UString::toEmpty($cuenta, 16);
    }
    
    /** recuperar el nombre del usuario */
    public function getNombre() {
        return $this->nombre;
    }
    
    /** asignar el nombre del usuario */
    public function setNombre($nombre) {
        $this->nombre = UString::toEmpty($nombre, 150);
    }
    
    /** recuperar el correo del usuario */
    public function getCorreo() {
        return $this->correo;
    }
    
    /** asignar el correo del usuario */
    public function setCorreo($correo) {
        $this->correo = UString::toEmpty($correo, 128);
    }
    
    /** recuperar el estatus del usuario */
    public function getEstatus() {
        return $this->estatus;
    }
    
    /** asignar el estatus del usuario */
    public function setEstatus($estatus) {
        $this->estatus = UsuarioEstatus::SinAsignar;
        if(UsuarioEstatus::isValidValue($estatus)) {
            $this->estatus = $estatus;
        }
    }
}