<?php

// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}

/**
 * Componente MVC View para la presentación de datos
 */
class View {

    // variables de trabajo
    private $viewName;
    private $showNavbar;
    private $vars = array();
    private $styles = array();
    private $scripts = array();
    private $includes = array();

    /**
     * Crear una instancia del tipo View
     * @param string $viewName nombre de la vista
     * @param boolean $showNavbar mostrar la barra de navegación
     */
    public function __construct($viewName, $showNavbar) {
        $this->viewName = MVC_VIEWS . $viewName . '.php';
        $this->showNavbar = $showNavbar;
    }

    /**
     * Agregar variables a la vista
     * @param string $varName nombre de la variable
     * @param mixed $varValue valor de la variable
     */
    public function addVar($varName, $varValue) {
        $this->vars[$varName] = $varValue;
    }

    /**
     * Agregar una hoja de estilo a la vista (generalmente un archivo CSS)
     * @param string $fileStyle nombre de archivo con extensión .css
     */
    public function addStyle($fileStyle) {
        $this->styles[] = $fileStyle;
    }

    /**
     * Agregar un javascript a la vista (generalmente un archivo JS)
     * @param string $fileScript nombre de archivo con extensión .js
     */
    public function addScript($fileScript) {
        $this->scripts[] = $fileScript;
    }

    /**
     * Incluir el contenido de un archivo a la vista (generarlmente un PHP)
     * @param string $fileName nombre de archivo con extensión .php
     */
    public function addInclude($fileName) {
        $this->includes[] = UString::replacePipe($fileName);
    }

    /**
     * Generar la vista de salida para presentar al usuario final
     */
    public function render() {
        // agregar los styles, scripts e includes como variables
        $this->vars['styles'] = $this->styles;
        $this->vars['scripts'] = $this->scripts;
        $this->vars['includes'] = $this->includes;

        // cargar las variables en la página de salida
        extract($this->vars);

        // iniciar el buffer de salida y ejecutar la página
        ob_start();

        // LAYOUT - header (cabecera de página)
        include_once(MVC_VIEWS . 'layout' . DS . 'header.php');
        if ($this->showNavbar == true) {
            // LAYOUT - navbar (barra de navegación)
            include_once(MVC_VIEWS . 'layout' . DS . 'navbar.php');
        }

        // cargar la vista de la página
        require_once($this->viewName);

        // LAYOUT - footer (pie de página)
        include_once(MVC_VIEWS . 'layout' . DS . 'footer.php');

        // cerrar el buffer de salida y enviar la página al cliente
        echo ob_get_clean();
    }

}
