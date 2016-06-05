<?php
if(!defined('ROOT_DIR')) { die('Acceso Denegado'); }

/**
* Controlador para iniciar la sesión de usuario
*/
final class LoginController extends Controller {
    
    function __construct() {
        // no require de login
        $this->setRequireLogin(false);
    }
    
    public function index() {
        // verificar si hay sesión de usuario iniciada
        if(Session::get(LOGIN_READY, false)){
            // navegar a la página predeterminada
            self::navigate(CONTROLLER_DEFAULT);
            return; // termina proceso
        }
        
        $mensaje = '';
        if(Request::isPostback()) {
            // validar la cuenta de usuario
            $usuario =$this->validarCuenta($mensaje);
            if($usuario != null) {
                // cargar la sesión del usuario
                Session::set(LOGIN_READY, true);
                Session::set(LOGIN_USER, $usuario->getId());
                Session::set(LOGIN_NAME, $usuario->getCuenta());
                Session::set(LOGIN_TITLE, $usuario->getNombre());
                
                // navegar a la pagina principal
                self::navigate(CONTROLLER_DEFAULT);
                return; // terminar proceso
            }
        }
        
        // configurar la vista para el login
        $view = $this->loadView('auth|login', false);
        $view->addVar('pageTitle', 'Control de Acceso');
        $view->addVar('mensaje', $mensaje);
        
        // agregar componentes adicionales
        $this->agregarComponentes($view);
        
        // presentar la vista
        $view->render();
    }
    
    private function validarCuenta(&$mensaje) {
        // validar los campos del formulario
        $usr = Request::getForm('txt_usr', '');
        $pwd = Request::getForm('txt_pwd', '');
        if(strlen($usr) == 0 || strlen($pwd) == 0) {
            $mensaje = 'La cuenta de usuario y la contraseña son requeridos.';
            return null; // terminar proceso
        }

        // cargar las clases y modelos necesarios        
        $this->loadClass('usuario'); // clase del tipo Usuario
        $this->loadModel('usuario'); // clase del tipo UsuarioModel
        $model = new UsuarioModel(); 

        // recuperar el ID asignado al usuario
        $id = $model->getLoginId($usr, $pwd);
        if($id == 0) {
            $mensaje = 'La cuenta de usuario o la contraseña es invalida.';
            return null; // terminar proceso
        }
        
        // recuperar el registro del usuario
        $reg = $model->getRegistro($id);
        if($reg->getTipo() == UsuarioTipo::SinAsignar || $reg->getEstatus() != UsuarioEstatus::Activo) {
            $mensaje = 'El tipo de usuario no es valido o la cuenta no esta activa.';
            return null; // terminar proceso
        }
        
        // el registro esta listo
        return $reg;
    }
    
    private function agregarComponentes($view) {
        // agregar las hojas de estilo para la vista
        $view->addStyle(Request::resolveUrl('theme/css/login.css'));
        
        // agregar los scripts para la vista
        $view->addScript(Request::resolveUrl('theme/js/jquery.backstretch.min.js'));
        
        // agregar los fragmentos de código a incluir
        $view->addInclude(MVC_VIEWS . 'auth|inc_login_script.php');
    }
}