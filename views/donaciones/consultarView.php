<?php
/**  @var $this \content\core\View */

$this->title = 'Donaciones'
?>
<div class="container-fluid">
    <div class="row center">
        <div class="col-md-8">
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="text-center mt-1"><?php echo $this->title; ?>
                        <a href="/donaciones/create" class="btn btn-success"><i class="bi bi-plus-circle"></i></a>
                    </h3>
                </div>
                <div class="card-body center table-wrap">
                    <table class="table table-bordered table-striped table-responsive table-hover w-100"
                           id="donaciones-table" data-route="donaciones/data">
                        <thead class="thead-primary">
                        <tr>
                            <th class="w-auto">Detalles</th>
                            <th class="w-auto">Donante</th>
                            <th class="w-auto">Cantidad</th>
                            <th class="w-auto">Disponible</th>
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
<div class="modal fade" id="observacion_donacion" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Miembros</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <form method="POST" id="form-registrar-observacion-donacion" action="/donaciones/guardar-observacion">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" required name="cantidad" class="form-control form-input mb-4"
                                               id="cantidad" value="" placeholder=" ">
                                        <label for="cantidad" class="form-label fw-bold">Cantidad:</label>
                                    </div>
                                </div>
                                <!-- ********************** -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <p class="">Descripcion:*</p>
                                            <textarea class="form-control" name="descripcion" id="descripcion"
                                                      rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="btn-group modal-footer" role="group" aria-label="">
                                <input type="hidden" required name="donacion_id" class="form-control form-input mb-4"
                                       id="donacion_id">
                                <button type="button" name="guardar_observacion_donacion" id="guardar_observacion_donacion" class="btn btn-success">Agregar
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