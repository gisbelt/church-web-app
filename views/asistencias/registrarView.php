<?php
/**  @var $this \content\core\View */

$this->title = 'Registrar Asistencias';
?>
<div class="container-fluid">
    <div class="row center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="card mb-5">
                <div class="card-header">
                    <a href="/asistencias" class="btn btn-outline-success text-center mt-3">Ver Lista de Asistencias</a>
                </div>
                <div class="card-body px-5 pb-5 pt-3">
                    <form method="POST" enctype="multipart/form-data" id="form-registrar-asistencias" action="/asistencias/guardar">  

                    <div class="form-group mb-4">
                        <p class="">Actividad:* </p>
                        <select class="form-select" name="actividad" id="actividad">
                            <option value="">Seleccione la Actividad</option>
                            <?php foreach ($actividades as $actividad) {
                                echo '<option value="' . $actividad[id] . '">' . $actividad[nombre] . '</option>';
                            } ?>
                        </select>
                    </div> 

                    <div class="form-group">
                        <div class="mb-4">
                            <p class="">Detalles:*</p>
                            <textarea class="form-control" name="detalles" id="detalles" rows="3"></textarea>
                        </div>
                    </div>
                    
                    <div class="btn-group modal-footer" role="group" aria-label="">
                        <button type="button" name="agregar-asistencia" id="agregar-asistencia" class="btn btn-success">Agregar</button>
                        <a name="limpiar" value="Limpiar" class="btn btn-secondary" onclick="limpiar();">Limpiar</a>
                    </div>
                    </form>
                </div><!--card-body-->
            </div><!--card-->
        </div> <!--col-md-12-->
    </div><!--row-->
</div><!--container-->
<!-- ********************************* -->
<script>
    function limpiar() {
        $("#form-registrar-asistencias")[0].reset();
        $("#actividad").focus();
    }
</script>