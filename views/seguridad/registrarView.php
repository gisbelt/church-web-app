<?php
/**  @var $this \content\core\View */

$this->title = 'Registrar permisos';
?>
<div class="container-fluid">
    <div class="row">
        <div class="offset-md-3  col-md-6">
            <div class="card">
                <div class="card-header mb-4">
                    <div>
                        <h5 class="p-0 absolute text-center"><?php echo $this->title; ?></h5>
                    </div>
                    <div class="derecha mb-2 p-2 " role="group" aria-label="">
                        <a href="/seguridad" class="btn btn-outline-success text-center">Ver listado</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="form-registrar-permisos" action="/seguridad/guardar">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" required name="nombre_permisos" class="form-control form-input mb-4"
                                        id="nombre_permisos" value="" placeholder="" autocomplete="off">
                                    <label for="nombre_permisos" class="form-label fw-bold">Nombre:*</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="btn-group modal-footer" role="group" aria-label="">
                            <button type="submit" name="agregar-permisos" id="agregar-permisos-rol" class="btn btn-success">Agregar</button>
                            <a name="limpiar" value="Limpiar" class="btn btn-secondary" onclick="limpiar();">Limpiar</a>
                        </div>
                    </form>
                </div><!--card-body-->
            </div><!--card-->
        </div> <!--col-md-12-->
    </div><!--row-->
</div><!--container-->