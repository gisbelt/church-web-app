<?php
/**  @var $this \content\core\View */
$this->title = 'Editar';
?>
<div class="container-fluid">
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="card">
                <div class="card-header mb-4">
                    <div>
                        <h5 class="p-0 absolute text-center"><?php echo $this->title; ?></h5>
                    </div>
                    <div class="derecha mb-2 p-2 " role="group" aria-label="">
                        <a href="/seguridad/roles" class="btn btn-outline-success text-center">Ver listado</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" id="form-actualizar-rol" action="/seguridad/roles/actualizar">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="nombre" class="form-control form-input mb-4"
                                           id="nombre"  value="<?php echo $role_nombre?>" autocomplete="off">
                                    <input type="hidden" name="rol" class="form-control form-input mb-4"
                                           id="nombre" value="<?php echo $rol?>" autocomplete="off">
                                    <label for="nombre_role" class="form-label fw-bold">Nombre:*</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="btn-group modal-footer" role="group" aria-label="">
                            <button type="submit" name="actualizar-rol" id="actualizar-rol" class="btn btn-success">Actualizar</button>
                        </div>
                    </form>
                </div><!--card-body-->
            </div><!--card-->
        </div> <!--col-md-12-->
    </div><!--row-->
</div><!--container-->