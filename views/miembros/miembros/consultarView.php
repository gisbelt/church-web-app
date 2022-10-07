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
                        <div class="col-12 col-sm-12 col-md-4 mb-2 mb-md-0">
                            <div class="form-group center">
                                <label>Nombre:</label>
                                <input type="text" required name="nombre" class="form-control form-input mb-4"
                                       id="nombre" value="" placeholder=" " autocomplete="off">
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-4 mb-2 mb-md-0">
                            <div class="form-group center">
                                <label>Sexo:</label>
                                <select class="form-select ms-2" id="sexo" name="sexo">
                                    <option value="">Todos</option>
                                    <option value="0">Femenino</option>
                                    <option value="1">Masculino</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-4 mb-2 mb-md-0">
                            <div class="form-group center">
                                <label>Fecha:</label>
                                <select class="form-select ms-2" id="tipo_fecha"">
                                <option value="">Seleccione</option>
                                <option value="1">Paso de fe</option>
                                <option value="2">Bautismo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-4 mb-2 mb-md-0">
                            <div class="input-group input-daterange" id="datepicker">
                                <input type="text" class="form-control form-input mb-4" name="fecha" id="fecha"
                                       placeholder=" " autocomplete="off">
                                <label for="fecha_paso_fe" class="form-label fw-bold">Fecha:*</label>
                                <span class="input-group-append">
                                        <span class="input-group-text bg-transparent border-0">
                                            <i class="bi bi-calendar-minus"></i>
                                        </span>
                                    </span>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <button type="button" name="busqueda_miembros" id="busqueda_miembros"
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

<div class="container-fluid mt-4"> <!--container-->
    <div class="row">
        <div class="col-md-12 table-wrap">
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
        </div>
    </div>
</div>

<script>
    // $(document).ready(function () {
    //     $("#miembro").on("keyup", function () {
    //         var value = $(this).val().toLowerCase();
    //         $("#myTable tr").filter(function () {
    //             $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    //         });
    //     });
    // });
</script>