<?php
/**  @var $this \content\core\View */

$this->title = 'Registrar Asistencias';
?>
<div class="container-fluid">
    <div class="row center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="card">
                <div class="card-header mb-4">
                    <div>
                        <h5 class="p-0 absolute text-center">Control de Asistencias</h5>
                    </div>
                    <div class="derecha mb-2 p-2 " role="group" aria-label="">
                        <a href="/asistencias" class="btn btn-outline-success text-center">Ver listado</a>
                    </div>
                </div>
                <div class="card-body ">
                    <form method="POST" enctype="multipart/form-data" id="form-registrar-asistencias" action="/asistencias/guardar">  

                    <div class="form-group mb-4">
                        <p class="">Actividad:* </p>
                        <select class="form-select" name="actividad" id="actividad">
                            <option value="">Selecione la Actividad</option>
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