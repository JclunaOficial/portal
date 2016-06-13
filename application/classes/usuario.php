<?php

// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}

// incluir la enumeraciones
require_once(UString::replacePipe(APP_CLASS . 'enums|usuario_tipo.php'));
require_once(UString::replacePipe(APP_CLASS . 'enums|usuario_estatus.php'));

/**
 * Información de un usuario
 */
final class Usuario {

    // declaración de atributos
    private $id;
    private $tipo;
    private $cuenta;
    private $correo;
    private $estatus;
    private $creado;

    /**
     * Crear una instancia del tipo Usuario
     */
    public function __construct() {
        // inicializar los atributos
        $this->id = 0;
        $this->tipo = UsuarioTipo::SinAsignar;
        $this->cuenta = '';
        $this->correo = '';
        $this->estatus = UsuarioEstatus::SinAsignar;
        $this->creado = new DateTime();
    }

    /**
     * Integrar el registro al objeto Usuario
     * @param array $registro información a cargar al objeto
     * @return \Usuario
     * @throws PortalException
     */
    public static function mapear($registro) {
        if ($registro == null || count($registro) == 0) {
            throw new PortalException('No hay información para cargar al objeto.');
        }

        // cargar la información
        $usuario = new Usuario();
        $usuario->setId(Model::getDataInteger($registro, 'id'));
        $usuario->setTipo(Model::getDataInteger($registro, 'tipo'));
        $usuario->setCuenta(Model::getDataString($registro, 'cuenta'));
        $usuario->setCorreo(Model::getDataString($registro, 'correo'));
        $usuario->setEstatus(Model::getDataInteger($registro, 'estatus'));
        return $usuario;
    }

    /**
     * Recuperar el ID del usuario
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Asignar el ID del usuario
     * @param int $id ID del usuario
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * Recuperar el tipo de usuario
     * @return int
     */
    public function getTipo() {
        return $this->tipo;
    }

    /**
     * Asignar el tipo de usuario
     * @param int $tipo tipo de usuario disponible en \UsuarioTipo
     */
    public function setTipo($tipo) {
        $this->tipo = UsuarioTipo::SinAsignar;
        if (UsuarioTipo::isValidValue($tipo)) {
            $this->tipo = $tipo;
        }
    }

    /**
     * Recuperar la cuenta de usuario
     * @return string
     */
    public function getCuenta() {
        return $this->cuenta;
    }

    /**
     * Asignar la cuenta de usuario
     * @param string $cuenta cuenta de usuario
     */
    public function setCuenta($cuenta) {
        $this->cuenta = UString::toEmpty($cuenta, 16);
    }

    /**
     * Recuperar el correo del usuario
     * @return string
     */
    public function getCorreo() {
        return $this->correo;
    }

    /**
     * Asignar el correo del usuario
     * @param string $correo correo del usuario
     */
    public function setCorreo($correo) {
        $this->correo = UString::toEmpty($correo, 128);
    }

    /**
     * Recuperar el estatus del usuario
     * @return int
     */
    public function getEstatus() {
        return $this->estatus;
    }

    /**
     * Asignar el estatus del usuario
     * @param int $estatus estatus de usuario disponible en \UsuarioEstatus
     */
    public function setEstatus($estatus) {
        $this->estatus = UsuarioEstatus::SinAsignar;
        if (UsuarioEstatus::isValidValue($estatus)) {
            $this->estatus = $estatus;
        }
    }

    /**
     * Recuperar la fecha y hora de creación del registro
     * @return DateTime
     */
    public function getCreado() {
        return $this->creado;
    }

    /**
     * Asignar la fecha y hora de creación del registro
     * @param DateTime $creado fecha y hora de creación del registro
     */
    public function setCreado($creado) {
        $this->creado = $creado;
    }

}
