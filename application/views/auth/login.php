<?php
// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}
?>

<div class="top-content">
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text">
                    <h1><?= PORTAL_TITLE; ?></h1>
                </div>
            </div>
            <div id="alert-caja" class="alert alert-danger" style="display: none;">
                <strong>ATENCIÓN [ <small><?= UString::formatNowTime(true); ?></small> ]</strong>:
                <span id="alert-mensaje"><?= (isset($mensaje) ? $mensaje : ''); ?></span>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h2>Control de Acceso</h2>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-lock"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <form role="form" action="" method="post" class="login-form">
                            <div class="form-group">
                                <label class="control-label" for="txt_usr">Cuenta de Usuario</label>
                                <input role="user" type="text" name="txt_usr" id="txt_usr" class="form-control form-usr" />
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="txt_pwd">Contraseña</label>
                                <input role="password" type="password" name="txt_pwd" id="txt_pwd" class="form-control form-pwd"/>
                            </div>

                            <button type="submit" class="btn btn-success">Iniciar Sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
