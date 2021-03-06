<?php
// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}
?>

</div>

<div id="page-footer">
    <div class="container text-muted text-center">
        <small>
            <strong><?= PORTAL_NAME; ?> v<?= PORTAL_VERSION; ?></strong><br/>
            <?= PORTAL_COPYRIGHT; ?>

        </small>
    </div>
</div>

<script type="text/javascript" src="<?= Request::resolveUrl('web/js/jquery.min.js'); ?>"></script>
<script type="text/javascript" src="<?= Request::resolveUrl('web/bs/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?= Request::resolveUrl('web/js/confirm-bootstrap.js'); ?>"></script>

<?php
if (isset($scripts) && count($scripts)) {
    // agregar los scripts definidos para la vista
    echo "\r\n"; // insertar una linea antes de la declaración de <script/>
    foreach ($scripts as $script) {
        echo "<script type='text/javascript' src='$script'></script>\r\n";
    }
}
?>

<script type="text/javascript" src="<?= Request::resolveUrl('web/js/portal.js'); ?>"></script>

<?php
if (isset($includes) && count($includes)) {
    // agregar los fragmentos definidos para la vista
    echo "\r\n"; // insertar una linea antes de integrar los fragmentos
    foreach ($includes as $file) {
        include_once($file);
        echo "\r\n";
    }
}
?>

</body>
</html>
