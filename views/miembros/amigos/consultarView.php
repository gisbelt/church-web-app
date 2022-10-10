<?php
/**  @var $this \content\core\View */

$this->title = 'Amigos';
?>
<div class="container-fluid">
<div class="row center">
    <div class="col-12 col-sm-12 col-md-12 col-lg-10">
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="text-center mt-1">Listado de Amigos <a href="/amigos/create" class="btn btn-success"><i class="bi bi-person-plus"></i></a></h3>
            </div>
            <div class="card-body py-4">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-3 mb-2 mb-md-0">
                        <div class="form-group mt-3">   
                            <input type="text" required name="cedula" class="form-control form-input mb-4"
                                   id="cedula" value="" placeholder=" " autocomplete="off">
                            <label for="cedula" class="form-label fw-bold">Cédula:</label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 mb-2 mb-md-0">
                        <div class="form-group">
                            <label>Sexo:</label>
                            <select class="form-select" id="sexo">
                                <option value="">seleccione...</option>
                                <option value="false">Femenino</option>
                                <option value="true">Masculino</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-4 mb-2 mb-md-0">
                        <label>Fecha de Nacimiento:</label>
                        <div class="input-group input-daterange" id="datepicker">
                            <span class="input-group-text">                        
                                <i class="bi bi-calendar-date text-first-color"></i>
                            </span>
                            <input type="text" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" placeholder="dd/mm/aaaa">
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <button type="button" name="busqueda_amigos" id="busqueda_amigos"
                                    class="btn btn-secondary btn-sm btn-block">
                                <i class="bi bi-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
            </div><!--card-body-->
        </div><!--card-->
    </div><!--col-->
</div><!-- row -->
</div><!--container-->

<div class="container-fluid">
    <div class="row center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-10">
            <div class="card mb-5">
                <div class="card-body center table-wrap">
                    <table class="table table-bordered table-striped table-responsive table-hover table-modal w-100"
                           id="lista-amigos-table" data-route="amigos/data">
                        <thead class="thead-primary">
                        <tr>
                            <th class="w-auto">Cedula</th>
                            <th class="w-auto">Nombre</th>
                            <th class="w-auto">sexo</th>
                            <th class="w-auto">Telefono</th>
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

<!-- Modal  -->
<div class="modal fade" id="convertir-miembro-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Miembros</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <form method="POST" enctype="multipart/form-data" id="form-amigo-miembro" action="/amigos/converti-miembro">
                            <div class="row">
                                <div class="form-group">
                                    <div class="input-group input-daterange" id="datepicker">
                                        <input type="text" class="form-control form-input mb-4" name="fecha_paso_fe" id="fecha_paso_fe" placeholder=" " autocomplete="off">
                                        <label for="fecha_paso_fe" class="form-label fw-bold">Fecha de paso de Fe:*</label>
                                        <span class="input-group-append">
                                        <span class="input-group-text bg-transparent border-0">
                                            <i class="bi bi-calendar-minus"></i>
                                        </span>
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-daterange" id="datepicker">
                                        <input type="text" class="form-control form-input mb-4" name="fecha_bautismo" id="fecha_bautismo" placeholder=" " autocomplete="off">
                                        <label for="fecha_bautismo" class="form-label fw-bold">Fecha de Bautismo:*</label>
                                        <span class="input-group-append">
                                        <span class="input-group-text bg-transparent border-0">
                                            <i class="bi bi-calendar-minus"></i>
                                        </span>
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <p class="">Membresía:* </p>
                                    <select class="form-select" name="membresia" id="membresia">
                                        <option value="">selecione membresias</option>
                                        <?php foreach ($membresias as $membresia) {
                                            echo '<option value="' . $membresia[id] . '">' . $membresia[nombre] . '</option>';
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <p class="">Cargo:* </p>
                                    <select class="form-select" name="cargo" id="cargo">
                                        <option value="">selecione cargo</option>
                                        <?php foreach ($cargos as $cargo) {
                                            echo '<option value="' . $cargo[id] . '">' . $cargo[nombre] . '</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="btn-group modal-footer" role="group" aria-label="">
                                <input type="hidden" name="amigo_id" class="form-control form-input mb-4"
                                       id="amigo_id">
                                <button type="button" name="amigo-miembro-guardar" id="amigo-miembro-guardar" class="btn btn-success">Agregar
                                </button>
                                <a name="limpiar" value="Limpiar" class="btn btn-secondary" onclick="limpiar();">Limpiar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal  -->