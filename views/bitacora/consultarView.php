<?php
/**  @var $this \content\core\View */

$this->title = 'Lista de bitacora'
?>
<div class="container-fluid">
    <div class="row center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-10">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="text-center mt-1"><?php echo $this->title; ?></h3>
                </div>
                <div class="card-body py-4">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4 mb-2 mb-md-0">
                            <div class="form-group">
                                <label>Usuario:</label>
                                <select class="form-select" id="sexo">
                                    <option value="">seleccione...</option>
                                    <?php foreach ($usuarios as $usuario) {
                                        echo '<option value="' . $usuario[id] . '">' . $usuario[username] . '</option>';
                                    } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-4 mb-2 mb-md-0">
                            <label>Fecha incial:</label>
                            <div class="input-group input-daterange" id="datepicker">
                            <span class="input-group-text">
                                <i class="bi bi-calendar-date text-first-color"></i>
                            </span>
                                <input type="text" name="fecha_inicial" id="fecha_inicial" class="form-control" placeholder="dd/mm/aaaa">
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-4 mb-2 mb-md-0">
                            <label>Fecha final:</label>
                            <div class="input-group input-daterange" id="datepicker">
                            <span class="input-group-text">
                                <i class="bi bi-calendar-date text-first-color"></i>
                            </span>
                                <input type="text" name="fecha_final" id="fecha_final" class="form-control" placeholder="dd/mm/aaaa">
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
                    <table class="table table-bordered table-striped table-responsive table-hover table-modal w-100" id="bitacora-table" data-route="/bitacora/data">
                        <thead class="thead-primary">
                        <tr>
                            <th class="w-auto">Descripcion</th>
                            <th class="w-auto">Modulo</th>
                            <th class="w-auto">Usuario</th>
                            <th class="text-center w-auto">Fecha</th>
                        </tr>
                        </thead>
                    </table>
                </div><!--card-body-->
            </div><!--card-->

        </div><!--col-md-8-->
    </div><!--row-->
</div><!--container-->

