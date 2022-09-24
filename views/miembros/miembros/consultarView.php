<?php
$this->title = 'Miembros';
?>
<div class="container-fluid">
<div class="row center">
    <div class="col-12 col-sm-12 col-md-12 col-lg-8">
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="text-center mt-1">Listado de Miembros <a href="/miembros/create" class="btn btn-success"><i class="bi bi-person-plus"></i></a></h3>
            </div>
            <div class="card-body py-4">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4 mb-2 mb-md-0">
                        <div class="form-group center">
                            <label>Sexo:</label>
                            <select class="form-select ms-2" id="sexo"">
                            <option value="">Todos</option>
                            <option value="">Femenino</option>
                            <option value="">Masculino</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-4 mb-2 mb-md-0">
                        <div class="form-group center">
                            <label>Fecha:</label>
                            <select class="form-select ms-2" id="status"">
                            <option value="">Todos</option>
                            <option value="">Paso de fe</option>
                            <option value="">Bautismo</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-4 mb-2 mb-md-0">
                        <div class="input-group input-daterange" id="datepicker">
                            <span class="input-group-text">                        
                                <i class="bi bi-calendar-date text-first-color"></i>
                            </span>
                            <input type="text" name="" id="" class="form-control" placeholder="Insertar" value="dd/mm/aaaa">
                            <span class="input-group-btn">
                                <button type="submit" name="" class="btn btn-secondary">Buscar</button>
                            </span>
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
            <table class="table table-bordered table-striped table-responsive table-hover table-modal w-100">
                <thead class="thead-primary">
                <tr>
                    <th class="w-auto">Cédula</th>
                    <th class="w-auto">Nombre</th>
                    <th class="w-auto">Teléfono</th>
                    <th class="w-auto">Dirección</th>
                    <th class="w-auto">Profesión</th>
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