<?php

// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}

/**
 * Funciones de utilidad especificas para el framework [Twitter Bootstrap]
 */
final class Bootstrap {

    /**
     * Recuperar mensaje de alerta de bootstrap
     * @param array $settings configuraciones para el mensaje de alerta
     * @return string estructura HTML del tipo 'bootstrap alert'
     */
    public static function getAlert($settings) {
        $type = 'info';
        if (array_key_exists('type', $settings)) {
            $type = $settings['type'];
        }

        $visible = '';
        if (array_key_exists('visible', $settings) && $settings['visible'] == false) {
            $visible = ' style="display:none;"';
        }

        $icon = '';
        if (array_key_exists('icon', $settings)) {
            $icon = "<i class='{$settings['icon']}'></i> ";
        }

        $title = '';
        if (array_key_exists('title', $settings)) {
            $title = ' ' . $settings['title'];
        }

        $showTime = '';
        if (array_key_exists('showTime', $settings) && $settings['showTime'] == true) {
            $showTime = '[ ' . UDate::formatTime() . ' ]';
        }

        $id = '';
        if (array_key_exists('id', $settings)) {
            $id = " id='{$settings['id']}'";
        }

        $message = '';
        if (array_key_exists('message', $settings)) {
            $message = " &mdash; <span{$id}>{$settings['message']}</span>";
        }

        $bs_tag = "<div class='alert alert-{$type}'{$visible}>";
        $bs_tag .= "<strong>{$icon}{$title} </strong>{$showTime}{$message}";
        $bs_tag .= "</div>";

        // regresar el tag final
        return $bs_tag;
    }

    /**
     * Recupera la barra de navegación de bootstrap
     * @param string $navbarXml archivo xml con la estructura de navegación
     * @return string estructura HTML del tipo 'bootstrap navbar'
     */
    public static function getNavbar($navbarXml) {
        $navbar = simplexml_load_file($navbarXml);
        $sb = '<ul class="nav navbar-nav">';

        foreach ($navbar->children() as $child) {
            $title = self::getTitle($child->attributes()->title);
            $url = self::getUrl($child->attributes()->url);
            $icon = self::getTagIcon($child->attributes()->icon);

            if ($child->count() > 0) {
                $sb .= '<li class="dropdown">';
                $sb .= self::getTagNavigation($title, $icon, $url, true);
                $sb .= self::getSubMenu($child);
                $sb .= '</li>';
            } else {
                $sb .= '<li>' . self::getTagNavigation($title, $icon, $url, false) . '</li>';
            }
        }

        $sb .= '</ul>' . "\r\n\r\n";
        return $sb;
    }

    private static function getSubMenu($node) {
        $sb = '<ul class="dropdown-menu">';
        foreach ($node->children() as $child) {
            $title = self::getTitle($child->attributes()->title);
            $url = self::getUrl($child->attributes()->url);
            $icon = self::getTagIcon($child->attributes()->icon);

            if (UString::startsWith($url, '#divider')) {
                $sb .= self::getTagDivider($title);
            } else {
                $sb.= '<li>' . self::getTagNavigation($title, $icon, $url, false) . '</li>';
            }
        }
        $sb .= '</ul>';
        return $sb;
    }

    private static function getTitle($value) {
        if (isset($value) && strlen($value) > 0) {
            return $value;
        }
        return "";
    }

    private static function getUrl($value) {
        if (isset($value) && strlen($value) > 0) {
            if (UString::startsWith($value, '~/')) {
                return str_replace('~/', Request::resolveUrl(''), $value);
            }
            return $value;
        }
        return "#";
    }

    private static function getTagIcon($value) {
        if (isset($value) && strlen($value) > 0) {
            return '<i class="' . $value . '"></i> ';
        }
        return "";
    }

    private static function getTagDivider($value) {
        if ($value != "") {
            return '<li class="dropdown-header">' . $value . '</li>';
        } else {
            return '<li class="divider"></li>';
        }
    }

    private static function getTagNavigation($title, $icon, $url, $dropdown) {
        return '<a href="' . $url . '"' .
                ($dropdown ? ' class="dropdown-toggle" data-toggle="dropdown">' : '>') .
                $icon . $title .
                ($dropdown ? ' <b class="caret"></b></a>' : '</a>');
    }

}
