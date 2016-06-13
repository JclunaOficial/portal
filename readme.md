# Portal Framework
**Portal Framework** es una adaptación del proyecto [Gilbitron/PIP](https://github.com/gilbitron/PIP), al
cual se le han agregado algunas mejoras, y una interface de usuario facil de adaptar a las necesidades
de proyectos nuevos o existentes si así se requiere.

## Journal

* Versión 2016.06.13
 * Integración de interface de usuario (UI) con el framework
  > * jQuery v1.12.3
   * Twitter Bootstrap v3.3.6
   * Font Awesome v4.3.0
 * Formulario para Login
 * Generación dinámica de la barra de navegación basado en un archivo XML (navbar.xml)
 * Integración de Helpers
  > * UString: funciones para la gestión de cadena de caracteres.
   * PortalException: clase para disparar excepciones personalizadas propias del framework.
   * Session: funciones para la gestión de las variables de sesión.
   * Request: funciones para la gestión de las variables de formularios enviados vía POST.
   * Enum: clase para la declaración y gestión de enumeraciones.
   * Bootstrap: funciones para generar dinámicamente elementos HTML propios del framework Twitter Bootstrap.


* Versión 2016.05.30
 * Iniciando con el proyecto base.