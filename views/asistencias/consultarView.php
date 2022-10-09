<?php
/**  @var $this \content\core\View */

$this->title = 'Listado de Asistencias'
?>
<div class="container-fluid">
    <div class="row center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-8">
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="text-center mt-1"><?php echo $this->title; ?>
                        <a href="/asistencias/create" class="btn btn-success" title="Agregar nuevo"><i class="bi bi-plus-circle"></i></a>
                    </h3>
                </div>
                <div class="card-body center table-wrap">
                    <table class="table table-bordered table-striped table-responsive table-hover table-modal w-100" id="asistencias-table" data-route="/asistencias/data">
                        <thead class="thead-primary">
                        <tr>
                            <th class="w-auto">Actividad</th>
                            <th class="w-auto">Detalles</th>
                            <th class="w-auto">Supervisor</th>
                            <th class="text-center w-auto">Acciones</th>
                        </tr>
                        </thead>
                    </table>
                </div><!--card-body-->
            </div><!--card-->

        </div><!--col-md-8-->
    </div><!--row-->
</div><!--container-->

