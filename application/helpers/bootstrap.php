<?php

final class Bootstrap {

    public static function getNavbar($file) {
        //$navbar = simplexml_load_file(APP_DIR . 'views' . DS . 'layout' . DS . 'navbar.xml');
        $navbar = simplexml_load_file($file);
        $sb = "<ul class='nav navbar-nav'>";

        foreach ($navbar->children() as $child) {
            $title = self::getTitle($child->attributes()->title);
            $url = self::getUrl($child->attributes()->url);
            $icon = self::getTagIcon($child->attributes()->icon);

            if ($child->count() > 0) {
                $sb .= "<li class='dropdown'>";
                $sb .= self::getTagNavigation($title, $icon, $url, true);
                $sb .= self::getSubMenu($child);
                $sb .= "</li>";
            } else {
                $sb .= "<li>" . self::getTagNavigation($title, $icon, $url, false) . "</li>";
            }
        }

        $sb .= "</ul>";
        return $sb;
    }

    private static function getSubMenu($node) {
        $sb = "<ul class='dropdown-menu'>";
        foreach ($node->children() as $child) {
            $title = self::getTitle($child->attributes()->title);
            $url = self::getUrl($child->attributes()->url);
            $icon = self::getTagIcon($child->attributes()->icon);

            if (UString::startsWith($url, '#divider')) {
                $sb.=self::getTagDivider($title);
            } else {
                $sb.="<li>" . self::getTagNavigation($title, $icon, $url, false) . "</li>";
            }
        }
        $sb.="</ul>";
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
            if(UString::startsWith($value, '~/')) {
                return str_replace('~/', Request::resolveUrl(''), $value);
            }
            return $value;
        }
        return "#";
    }

    private static function getTagIcon($value) {
        if (isset($value) && strlen($value) > 0) {
            return "<i class='" . $value . "'></i> ";
        }
        return "";
    }

    private static function getTagDivider($value) {
        if ($value != "") {
            return "<li class='dropdown-header'>" . $value . "</li>";
        } else {
            return "<li class='divider'></li>";
        }
    }

    private static function getTagNavigation($title, $icon, $url, $dropdown) {
        return "<a href='" . $url . "'" .
                ($dropdown ? " class='dropdown-toggle' data-toggle='dropdown'>" : ">") .
                $icon . $title .
                ($dropdown ? " <b class='caret'></b></a>" : "</a>");
    }

}
