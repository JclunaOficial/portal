<?php

// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}

/**
 * Controlador para Login
 */
final class LoginController extends Controller {

    /**
     * Crear una instancia del tipo LoginController
     */
    function __construct() {
        // este controlador no requiere del login (evitar un loop infinito)
        $this->setLoginRequired(false);
    }

    /**
     * Acción principal del controlador
     * @return void
     */
    public function index() {
        // verificar si hay sesión de usuario iniciada
        if (Session::getValue(LOGIN_READY, false)) {
            // navegar a la página predeterminada
            self::navigate(CONTROLLER_DEFAULT);
            return; // termina proceso
        }

        $mensaje = '';
        if (Request::isPostback()) {
            // validar la cuenta de usuario
            $usuario = $this->validarCuenta($mensaje);
            if ($usuario != null) {
                // cargar la sesión del usuario
                Session::setValue(LOGIN_READY, true);
                Session::setValue(LOGIN_USER, $usuario->getId());
                Session::setValue(LOGIN_NAME, $usuario->getCuenta());
                Session::setValue(LOGIN_TITLE, $usuario->getCorreo());

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
        if (strlen($usr) == 0 || strlen($pwd) == 0) {
            $mensaje = 'La cuenta de usuario y la contraseña son requeridos.';
            return null; // terminar proceso
        }

        // cargar el modelo para la gestion de usuarios        
        $this->loadModel('usuario');
        $model = new UsuarioModel();

        // recuperar el ID asignado al usuario
        $id = $model->getLoginId($usr, $pwd);
        if ($id == 0) {
            $mensaje = 'La cuenta de usuario o la contraseña es invalida.';
            return null; // terminar proceso
        }

        // recuperar el registro del usuario
        $reg = $model->getUsuario($id);
        if ($reg->getTipo() == UsuarioTipo::SinAsignar || $reg->getEstatus() != UsuarioEstatus::Activo) {
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
        $view->addInclude(MVC_VIEWS . 'auth|login_js.php');
    }

}
