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
                        <div class="form-group">
                            <label>Cedula:</label>
                            <input type="text" required name="cedula" class="form-control form-input mb-4"
                                   id="cedula" value="" placeholder=" " autocomplete="off">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-3 mb-2 mb-md-0">
                        <div class="form-group">
                            <label>Sexo:</label>
                            <select class="form-select" id="sexo">
                                <option value="">seleccione...</option>
                                <option value="false">Femenino</option>
                                <option value="true">Masculino</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-3 mb-2 mb-md-0">
                        <div class="form-group">
                            <label>Status:</label>
                            <select class="form-select" id="status">
                                <option value="">seleccione...</option>
                                <option value="true">Activos</option>
                                <option value="false">Inactivos</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-3 mb-2 mb-md-0">
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