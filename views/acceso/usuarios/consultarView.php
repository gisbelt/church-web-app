<?php
/**  @var $this \content\core\View */

$this->title = 'Usuarios';
?>
<h3 class="text-center mb-4">Listado de usuarios <a href="/usuarios/create" class="btn btn-success"><i
                class="bi bi-person-plus"></i></a></h3>

<div class="container-fluid mt-3">
    <div class="row">
        <div class="offset-md-2 col-md-8">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="row">
                        <form action="" method="post">
                            <div class="col-4 col-sm4 col-md-4 mb-2 mb-md-0">
                                <label>Cargo:</label>
                                <select class="form-select ms-2" id="cargo" name="cargo">
                                    <option value="">Todos</option>
                                    <?php foreach ($cargos as $cargoo) {
                                        echo '<option value="' . $cargoo[id] . '">' . $cargoo[nombre] . '</option>';
                                    } ?>
                                </select>
                            </div>

                            <div class="col-4 col-sm-4 col-md-4 mb-2 mb-md-0">
                                <label>Estado:</label>
                                <select class="form-select ms-2" id="status"">
                                <option value="">Todos</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                                </select>
                            </div>

                            <div class="col-4 col-sm-4 col-md-4 mb-2 mb-md-0">
                                <div class="input-group">
                                    <input type="text" name="" id="miembro" class="form-control"
                                           placeholder="Nombre...">
                                    <span class="input-group-btn">
                                        <button type="submit" name="" class="btn btn-secondary">Buscar</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-md-8-->
    </div><!--row-->
</div><!--container-->

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
