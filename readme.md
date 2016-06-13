# Portal Framework
**Portal Framework** es una adaptación del proyecto [Gilbitron/PIP](https://github.com/gilbitron/PIP), al
cual se le han agregado algunas mejoras, y una interface de usuario facil de adaptar a las necesidades
de proyectos nuevos o existentes si así se requiere.

Tomando la filosofia de Gilbitron, el proyecto pretende ser lo más simple posible para configurarlo y usarlo.
Se puede trabajar en diferentes plataformas (`Windows, Linux, OSX`) siempre y cuando se cuente con los requerimientos
especificados. También se puede usar con un enterno de desarrollo (Stack) `LAMP, WAMP, XAMPP` cumpliendo los requerimientos.

### Requerimientos
* PHP v5.1 o superior
* MySQL v4.1.2 o superior
* El modulo Apache mod_rewrite habilitado

### Instalación
* Descargue y extraiga Portal
* Abra el archivo `application/settings.php` y asigne el valor de `BASE_URL` (ej. `portal/`)
* Navega con tu explorador de internet a la `BASE_URL` configurada (ej. `http://localhost/portal/`) y veras un formulario de login
* Para entrar como usuario capturar el valor `usuario` en los campos 'cuenta de usuario' y 'contraseña'; y para entrar como administrador capturar el valor `admin`.

### Licencia
**Portal** esta liberado bajo la licencia MIT

Si quieres contribuir a mejorar este proyecto o tienes dudas, por favor unete al proyecto y envia tus comentarios usando las herramientas que github nos ofrece.

### Jornada

* Versión 2016.06.13
  * Integración de interface de usuario (UI) con los frameworks
    * jQuery v1.12.3
    * Twitter Bootstrap v3.3.6
    * Font Awesome v4.3.0

 * Formulario para Login
 * Generación dinámica de la barra de navegación basado en un archivo XML (navbar.xml)
 * Integración de Helpers
    * UString: funciones para la gestión de cadena de caracteres.
    * PortalException: clase para disparar excepciones personalizadas propias del framework.
    * Session: funciones para la gestión de las variables de sesión.
    * Request: funciones para la gestión de las variables de formularios enviados vía POST.
    * Enum: clase para la declaración y gestión de enumeraciones.
    * Bootstrap: funciones para generar dinámicamente elementos HTML propios del framework Twitter Bootstrap.

* Versión 2016.05.30
 * Iniciando con el proyecto base.
