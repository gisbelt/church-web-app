<?php
$this->title = 'Miembros';
?>
<div class="container-fluid">
    <div class="row center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-10">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="text-center mt-1">Listado de Miembros <a href="/miembros/create" class="btn btn-success"><i
                                    class="bi bi-person-plus"></i></a></h3>
                </div>
                <div class="card-body py-4">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-3 mb-2 mb-md-0">
                            <div class="form-group center">
                                <input type="text" required name="nombre" class="form-control form-input mb-4"
                                       id="nombre" value="" placeholder=" " autocomplete="off">
                                <label for="nombre" class="form-label fw-bold">Nombre:</label>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-3 mb-2 mb-md-0">
                            <div class="form-group center">
                                <label>Sexo:</label>
                                <select class="form-select ms-2" id="sexo" name="sexo">
                                    <option value="">Todos</option>
                                    <option value="false">Femenino</option>
                                    <option value="true">Masculino</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-3 mb-2 mb-md-0">
                            <div class="form-group center">
                                <label>Fecha:</label>
                                <select class="form-select ms-2" id="tipo_fecha"">
                                <option value="">Tipo de fecha</option>
                                <option value="1">Paso de fe</option>
                                <option value="2">Bautismo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-3 mb-2 mb-md-0">
                            <div class="form-group center">
                                <div class="input-group input-daterange" id="datepicker">
                                    <span class="input-group-text">                        
                                        <i class="bi bi-calendar-date text-first-color"></i>
                                    </span>
                                    <input type="text" class="form-control" name="fecha" id="fecha" placeholder="Insertar Fecha" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-2">
                            <div class="form-group">
                                <button type="button" name="busqueda_miembros" id="busqueda_miembros"
                                        class="btn btn-secondary btn-block">
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
                           id="miembros-table" data-route="miembros/data">
                        <thead class="thead-primary">
                        <tr>
                            <th class="w-auto">Cédula</th>
                            <th class="w-auto">Nombre</th>
                            <th class="w-auto">Teléfono</th>
                            <th class="w-auto">Status</th>
                            <th class="w-auto">Paso de Fe</th>
                            <th class="w-auto">Bautismo</th>
                            <th class="text-center w-auto">Acciones</th>
                        </tr>
                        </thead>
                    </table>
                </div><!--card-body-->
            </div><!--card-->

        </div><!--col-md-8-->
    </div><!--row-->
</div><!--container-->