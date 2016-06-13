<?php

// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}

// incluir las clases que consume el modelo
require_once(UString::replacePipe(APP_CLASS . 'usuario.php'));

/**
 * Modelo para la gestion de usuarios
 */
final class UsuarioModel extends Model {

    /**
     * Recuperar el ID del usuario usando la cuenta y la contraseña
     * @param string $cuenta nombre de la cuenta de usuario
     * @param string $password contraseña de seguridad
     * @return int ID del usuario localizados; si no existe, el valor es 0
     */
    public function getLoginId($cuenta, $password) {
        // TODO: implementar la lógica con una base de datos
        $usr = UString::toLower($cuenta);
        $pwd = UString::toLower($password);
        if($usr == '' || $pwd == '') {
            // debe haber datos en los dos parametros
            return 0;
        }

        if($usr == 'usuario' && $pwd == 'usuario') {
            // emular ID 1 para cuenta de usuario
            return 1;
        }

        if($usr == 'admin' && $pwd == 'admin') {
            // emular ID 2 para cuenta de administrador
            return 2;
        }
    }

    /**
     *  Recuperar el registro de un usuario
     * @param int $id ID del usuario
     * @return \Usuario
     */
    public function getUsuario($id) {
        // TODO: implementar la lógica con una base de datos
        if($id < 1 || $id > 2) {
            // el ID debe ser 1 o 2
            return null;
        }

        $usuario = new Usuario();
        switch($id) {
            case 1:
                $usuario->setId(1); // cuenta para usuario
                $usuario->setTipo(UsuarioTipo::Usuario);
                $usuario->setCuenta('Dummy, Usuario');
                $usuario->setCorreo('usuario@portal.mx');
                $usuario->setEstatus(UsuarioEstatus::Activo);
                break;

            case 2:
                $usuario->setId(2); // cuenta para administrador
                $usuario->setTipo(UsuarioTipo::Administrador);
                $usuario->setCuenta('Dummy, Administrador');
                $usuario->setCorreo('admin@portal.mx');
                $usuario->setEstatus(UsuarioEstatus::Activo);
                break;
        }

        // regresar el registro
        return $usuario;
    }

}
