<?php
if(!defined('ROOT_DIR')) { die('Acceso Denegado'); }

final class UsuarioModel extends Model {
    
    /**
    * Recuperar el ID del usuario usando el nombre de la cuenta y la contraseña
    */
    public function getLoginId($cuenta, $password) {
        // TODO: implementar el acceso a la base de datos
        if($cuenta == 'usuario' && $password == 'usuario') {
            return 1; // ID para usuario            
        }
        elseif($cuenta == 'admin' && $password == 'admin') {
            return 2; // ID para administrador
        }
        return 0; // sin identificación
    }
    
    public function getRegistro($id) {
        // TODO: implementar el acceso a la base de datos
        switch ($id) {
            case 1:
                $usr = new Usuario();
                $usr->setId($id);
                $usr->setTipo(UsuarioTipo::Usuario);
                $usr->setCuenta('usuario');
                $usr->setNombre('Juan Perez');
                $usr->setCorreo('usuario@portal.net');
                $usr->setEstatus(UsuarioEstatus::Activo);
                return $usr;
                
            case 2:
                $usr = new Usuario();
                $usr->setId($id);
                $usr->setTipo(UsuarioTipo::Administrador);
                $usr->setCuenta('admin');
                $usr->setNombre('Administrador');
                $usr->setCorreo('admin@portal.net');
                $usr->setEstatus(UsuarioEstatus::Activo);
                return $usr;
                
            default:
                return null;
        }
    }
}