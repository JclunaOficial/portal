<?php
// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}

$themeName = Session::getValue(THEME_NAME, DEFAULT_THEME_NAME);
$themeNavbar = Session::getValue(THEME_NAVBAR, DEFAULT_THEME_NAVBAR);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="robots" content="noindex, nofollow" />

        <title><?= PORTAL_TITLE; ?><?= (isset($pageTitle) ? ' &mdash; ' . $pageTitle : ''); ?></title>

        <link type="text/css" rel="stylesheet" href="<?= Request::resolveUrl('web/fa/css/font-awesome.min.css'); ?>"/>
        <link type="text/css" rel="stylesheet" href="<?= Request::resolveUrl('web/bs/css/bootstrap-' . $themeName . '.min.css'); ?>"/>

        <?php
        if (isset($styles) && count($styles)) {
            // agregar las hojas de estilo definidas para la vista
            echo "\r\n"; // insertar una linea antes de la declaración de stylesheet
            foreach ($styles as $style) {
                echo "<link type='text/css' rel='stylesheet' href='$style'/>\r\n";
            }
        }
        ?>

        <link type="text/css" rel="stylesheet" href="<?= Request::resolveUrl('web/css/portal.css'); ?>"/>

        <!--[if lt IE 9]>
        <script type="text/javascript" src="<?= Request::resolveUrl('web/js/html5shiv.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= Request::resolveUrl('web/js/respond.min.js'); ?>"></script>
        <![endif]-->
    </head>
    <body role="document">
        <div id="page-wrapper">
