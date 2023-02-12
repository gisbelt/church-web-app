<?php
/**  @var $this \content\core\View */

$this->title = 'Editar Asistencias';
?>
<div class="container-fluid">
    <div class="row center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="card mb-5">
                <div class="card-header">
                    <a href="/asistencias" class="btn btn-outline-success text-center mt-3">Ver Lista de Asistencias</a>
                </div>
                <div class="card-body px-5 pb-5 pt-4">
                    <form method="POST" enctype="multipart/form-data" id="form-actualizar-asistencia" action="/asistencias/actualizar">  

                    <div class="form-group mb-4">
                        <p class="">Actividad:* </p>
                        <select class="form-select" name="actividad" id="actividad" disabled>
                            <option value="<?php echo $actividad_id ?>"><?php echo $nombre ?></option>
                            <?php foreach ($actividades as $actividad) {
                                echo '<option value="' . $actividad[id] . '">' . $actividad[nombre] . '</option>';
                            } ?>
                        </select>
                        <input type="hidden" name="asistencia" class="form-control form-input mb-4" value="<?php echo $asistencia ?>" autocomplete="off">
                    </div> 

                    <div class="form-group">
                        <div class="mb-4">
                            <p class="">Detalles:*</p>
                            <textarea class="form-control" name="detalles" id="detalles" rows="3"><?php echo $detalles ?></textarea>
                        </div>
                    </div>
                    
                    <div class="btn-group modal-footer" role="group" aria-label="">
                        <button type="button" name="actualizar-asistencia" id="actualizar-asistencia" class="btn btn-success">Actualizar</button>
                    </div>
                    </form>
                </div><!--card-body-->
            </div><!--card-->
        </div> <!--col-md-12-->
    </div><!--row-->
</div><!--container-->
<!-- ********************************* -->