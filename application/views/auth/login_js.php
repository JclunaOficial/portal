<?php
// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}
?>

<script type="text/javascript">
    $(document).ready(function () {
        // presentar imagen de fondo y mover cursor al campo de usuario
        $.backstretch("<?= Request::resolveUrl('web/img/login_bg.jpg'); ?>");
        $("#txt_usr").focus();

        // validar la cuenta de usuario y contraseña: son requeridos
        $('.login-form input[type="text"], .login-form input[type="password"]').on('focus', function () {
            $(this).parent().removeClass('has-error');
        });

        $('.login-form').on('submit', function (e) {
            $(this).find('input[type="text"],input[type="password"]').each(function () {
                if ($(this).val() === "") {
                    e.preventDefault();
                    $(this).parent().addClass('has-error');
                } else {
                    $(this).parent().removeClass('has-error');
                }
            });
        });

        // presentar alerta si hay mensaje 
        var msg = $("#alert-mensaje").text();
        if (msg.length > 0) {
            $("#alert-caja").toggle();
        }
    });
</script>
