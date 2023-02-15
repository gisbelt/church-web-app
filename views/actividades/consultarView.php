<?php
/**  @var $this \content\core\View */

$this->title = 'Listado de Actividades'
?>
<div class="container-fluid">
    <div class="row center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-10">
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="text-start mt-1"><?php echo $this->title; ?> </h3>
                    <div class="d-flex gap-5">
                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crear-actividad">
                            Nuevo
                            <i class="bi bi-plus-circle mx-1"></i>
                        </a> 
                        <div class="tabs tabs-nav" id="nav-tab" role="tablist">
                            <button class="tabs-link active" id="calendar-tab">Calendario</button>
                            <button class="tabs-link" id="actividad-tab">Ver Lista</button>
                        </div>
                    </div>                                                                 
                </div>
                <div class="card-body table-wrap">                    
                        <div class="tabs-content active-tab" id="calendar-tab">
                            <div id="calendario"></div>
                        </div>

                        <div class="tabs-content hidden" id="actividad-tab">
                            <table class="table table-bordered table-striped table-responsive table-hover w-100"
                                id="actividad-table" data-route="actividad/data">
                                <thead class="thead-primary">
                                <tr>
                                    <th class="w-auto">Nombre</th>
                                    <th class="w-auto">Descripcion</th>
                                    <th class="w-auto">status</th>
                                    <th class="w-auto">Tipo</th>
                                    <th class="w-auto">Fecha</th>
                                    <th class="text-center w-auto">Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                </div><!--card-body-->
            </div><!--card-->
        
        </div><!--col-md-8-->
    </div><!--row-->
</div><!--container-->

<!-- Modal  -->
<div class="modal fade" id="crear-actividad" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header b-0">
                <h5 class="modal-title fw-bold">Crear nueva actividad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body w-100">
            <?php require_once "./../views/actividades/registrarElement.php"; ?>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- ********************************* -->

<script> 
   function limpiar() {
        $("#form-registrarActividades")[0].reset();
    }
</script>
