<?php

class View {
    
    private $viewName;  // nombre de la vista a presentar
    private $navbar;    // presentar la barra de navegación (si hay sesión y la página lo requiere)
   
    // elementos que serán integrados en la página de salida
    private $vars     = array(); // variables de página
    private $includes = array(); // lista de includes (código adicional)
    private $styles   = array(); // lista de hojas de estilo
    private $scripts  = array(); // lista de scripts (js/vbs)
    
    public function __construct($viewName, $navbar) {
        $this->navbar = $navbar;
        $this->viewName = MVC_VIEWS . $viewName . '.php';
    }
    
    public function addVar($var, $val) {
        $this->vars[$var] = $val;
    }
    
    public function addStyle($style) {
        $this->styles[] = $style;
    }
    
    public function addScript($script) {
        $this->scripts[] = $script;
    }
    
    public function addInclude($file) {
        $this->includes[] = $file;
    }
    
    public function render() {
        // agregar los styles, scripts e includes como variables
        $this->vars['styles']   = $this->styles;
        $this->vars['scripts']  = $this->scripts;
        $this->vars['includes'] = $this->includes;
        
        // cargar las variables en la página de salida
        extract($this->vars);
        
        // iniciar el buffer de salida y ejecutar la página
        ob_start(); 
        
        // LAYOUT - header (cabecera de página)
        include_once(MVC_VIEWS . 'layout' . DS . 'header.php');
        if($this->navbar == true) {
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