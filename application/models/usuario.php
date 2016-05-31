<?php

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
                $usr->id = $id;
                $usr->tipo = Usuario::TIPO_USUARIO;
                $usr->cuenta = 'usuario';
                $usr->correo = 'usuario@portal.net';
                $usr->estatus = Usuario::ESTATUS_ACTIVO;
                return $usr;
                
            case 2:
                $usr = new Usuario();
                $usr->id = $id;
                $usr->tipo = Usuario::TIPO_ADMIN;
                $usr->cuenta = 'admin';
                $usr->correo = 'admin@portal.net';
                $usr->estatus = Usuario::ESTATUS_ACTIVO;
                return $usr;
                
            default:
                return null;
        }
    }
}