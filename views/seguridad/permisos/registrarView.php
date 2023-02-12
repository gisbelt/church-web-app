<?php
/**  @var $this \content\core\View */

$this->title = 'Registrar permisos';
?>
<div class="container-fluid">
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="card mb-5">
                <div class="card-header">
                    <a href="/seguridad/permisos" class="btn btn-outline-success text-center mt-3">Ver Lista de Permisos</a>
                </div>
                <div class="card-body px-5 pb-5 pt-4">
                    <form method="post" id="form-registrar-permisos" action="/seguridad/permisos/guardar">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="nombre" class="form-control form-input mb-4"
                                        id="nombre" placeholder=" " autocomplete="off">
                                    <label for="nombre_permisos" class="form-label fw-bold">Nombre:*</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="btn-group modal-footer" role="group" aria-label="">
                            <button type="submit" name="agregar-permisos" id="agregar-permisos" class="btn btn-success">Agregar</button>
                        </div>
                    </form>
                </div><!--card-body-->
            </div><!--card-->
        </div> <!--col-md-12-->
    </div><!--row-->
</div><!--container-->