<?php
/**  @var $this \content\core\View */

$this->title = 'Usuarios';
?>

<div class="container-fluid">
<div class="row">
    <div class="offset-md-2 col-md-8">
        <div class="card mb-5">
            <div class="card-header">
                <h3 class="text-center mb-4">Listado de usuarios <a href="/usuarios/create" class="btn btn-success"><i
                                class="bi bi-person-plus"></i></a></h3>
            </div>
            <div class="card-block p-5">
                <div class="row">
                    <div class="col-md-4">
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Estado:</label>
                            <select class="form-select" id="status" name="status">
                                <option value="">Todos</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Estado:</label>
                            <select class="form-select" id="miembro" name="miembro">
                                <option value="">selecione miembro</option>
                                <?php foreach ($miembros as $miembro) {
                                    echo '<option value="' . $miembro[miembro] . '">' . $miembro[nombre_completo] . '</option>';
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <button type="button" name="busqueda_usuario" id="busqueda_usuario"
                                    class="btn btn-secondary btn-sm btn-block">
                                <i class="bi bi-search"></i> Buscar
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
    <div class="row">
        <div class="offset-md-2 col-md-8">
            <div class="card mb-5">
                <div class="card-body center">
                    <table class="table table-bordered table-striped table-responsive table-hover w-100"
                           id="usuarios-table" data-route="usuarios/data">
                        <thead class="thead-primary">
                        <tr>
                            <th class="w-auto">Nombre</th>
                            <th class="w-auto">Correo</th>
                            <th class="w-auto">Cargo</th>
                            <th class="text-center w-auto">Acciones</th>
                        </tr>
                        </thead>
                    </table>
                </div><!--card-body-->
            </div><!--card-->

        </div><!--col-md-8-->
    </div><!--row-->
</div><!--container-->
