<?php
// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}
?>

<div class="navbar navbar-<?= $themeNavbar; ?>" role="navbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Navigate</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= Request::resolveUrl(''); ?>">
                <strong><?= PORTAL_TITLE; ?></strong>
            </a>
        </div>

        <div id="main" class="collapse navbar-collapse">
            <?php if (Session::getValue(LOGIN_READY, false)) { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="<?= Session::getValue(LOGIN_TITLE); ?>">
                            <b class="fa fa-user"></b>&nbsp; <?= Session::getValue(LOGIN_NAME); ?> <i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-tasks"></i> Mi Perfil</a></li>
                            <li><a href="#"><i class="fa fa-gear"></i> Configuración</a></li>
                            <li class="divider"></li>
                            <li><a href="<?= Request::resolveUrl('auth/logout'); ?>"><b class="fa fa-power-off"></b> Terminar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            <?php } ?>

            <?= Bootstrap::getNavbar(MVC_VIEWS . 'layout/navbar.xml'); ?>
        </div>
    </div>
</div>
