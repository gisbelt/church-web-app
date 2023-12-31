<?php
/**  @var $this \content\core\View */

$this->title = 'Usuarios';
?>

<div class="container-fluid">
<div class="row center">
    <div class="col-12 col-sm-12 col-md-12 col-lg-8">
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="text-start mt-1">Listado de usuarios </h3>
                <a href="/usuarios/create" class="btn btn-success">
                    Nuevo
                    <i class="bi bi-person-plus mx-1"></i>
                </a>
            </div>
            <div class="card-body px-5 pb-5 pt-2">
                <div class="row">
                    <div class="col-12 col-md-4 mb-2 mb-md-0">
                        <div class="form-group">
                            <label>Cargo:</label>
                            <select class="form-select" id="cargo" name="cargo">
                                <option value="">Todos</option>
                                <?php foreach ($cargos as $cargoo) {
                                    echo '<option value="' . $cargoo[id] . '">' . $cargoo[nombre] . '</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-2 mb-md-0">
                        <div class="form-group">
                            <label>Estado:</label>
                            <select class="form-select" id="status" name="status">
                                <option value="">Todos</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-2 mb-md-0">
                        <div class="form-group">
                            <label>Miembro:</label>
                            <select class="form-select" id="miembro" name="miembro">
                                <option value="">Selecione Miembro</option>
                                <?php foreach ($miembros as $miembro) {
                                    echo '<option value="' . $miembro[miembro] . '">' . $miembro[nombre_completo] . '</option>';
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <button type="button" name="busqueda_usuario" id="busqueda_usuario"
                                    class="btn btn-secondary btn-block">
                                Buscar <i class="bi bi-search mx-1"></i> 
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="container-fluid">
    <div class="row center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-8">
            <div class="card mb-5">
                <div class="card-body center table-wrap">
                    <table class="table table-bordered table-striped table-responsive table-hover table-modal w-100"
                           id="usuarios-table" data-route="usuarios/data">
                        <thead class="thead-primary">
                        <tr>
                            <th class="w-auto">Nombre</th>
                            <th class="w-auto">Correo</th>
                            <th class="w-auto">Cargo</th>
                            <th class="w-auto">Status</th>
                            <th class="text-center w-auto">Acciones</th>
                        </tr>
                        </thead>
                    </table>
                </div><!--card-body-->
            </div><!--card-->

        </div><!--col-md-8-->
    </div><!--row-->
</div><!--container-->
