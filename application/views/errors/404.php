<?php
// prevenir el acceso directo
if (!defined('ROOT_DIR')) {
    die('Usted no puede cargar esta pagina directamente.');
}
?>

<br/>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="text-center text-primary">¿Donde Estas?</h1><hr/>
            <h3 class="text-center text-danger">Esto no se parece a la página que querías visitar, ¿verdad?</h3><hr/>
            <div class="row">
                <div class="col-md-6">
                    <p>Esta página no se pudo encontrar. Es posible que haya seguido un enlace incorrecto, 
                        o simplemente haya escrito mal la URL. También es posible que nosotros hayamos 
                        cambiado el nombre, movido o eliminado el contenido.</p>
                    <p>¿Le gustaría ayudar a mejorar nuestro sitio web? Sólo hay que rellenar el formulario 
                        y nosotros le damos seguimiento.</p>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="">Tu Correo</label>
                        <input type="text" class="form-control" id="txt_correo" />
                    </div>
                    <div class="form-group">
                        <label clas="control-label" for="">Mensaje de Ayuda</label>
                        <textarea class="form-control" id="txt_mensaje" rows="3" placeholder="Por favor, describa la forma en que aterrizó en esta página"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2 text-center">
            <hr/>
            <a href="<?= Request::resolveUrl(''); ?>" class="btn btn-primary"><i class="fa fa-home"></i> Página Principal</a>
            <button class="btn btn-info"><i class="fa fa-inbox"></i> Ayudar a Mejorar</button>
        </div>
    </div>
</div>
