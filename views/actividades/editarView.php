<?php
    /**  @var $this \content\core\View */
    
    $this->title = 'Editar Actividades'
?>
<div class="container-fluid">
    <div class="row center">
        <div class="col-md-6">
            <div class="card mb-5">
                <div class="card-header">
                    <a href="/actividades" class="btn btn-outline-success text-center mt-3">Ver Lista de Actividades</a>
                </div>
                <div class="card-body px-5 pb-5 pt-4">
                    <form method="POST" enctype="multipart/form-data" id="form-actualizar-actividades" action="/actividades/update">
                        <div class="form-group">
                            <div class="mb-4">
                                <p class="">Miembro: </p>                                
                                <select class="form-control" name="miembro_id" id="miembro_id">
                                
                                </select>
                            </div>
                        </div>
                        <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
                        <div class="form-group">
                            <input type="text" required name="nombre" class="form-control form-input mb-4" id="nombre" value="<?php echo $nombre ?>" placeholder=" " >
                            <label for="nombre" class="form-label fw-bold">Nombre de la Actividad:*</label>
                        </div>
                        <div class="form-group">
                            <div class="mb-3">
                                <p class="">Descripción:*</p>
                                <textarea class="form-control" name="descripcion" id="descripcion" rows="3"><?php echo $descripcion ?></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <p class="">Tipo de actividad:* </p>
                            <select class="form-control" name="tipo_actividad" id="tipo_actividad">
                                <option value="<?php echo $id_tipo ?>"><?php echo $tipo ?></option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <p class="">Estado:* </p>
                            <select class="form-control" name="status" id="status">
                                <option value="<?php echo $estado_id ?>" selected><?php echo $estado ?></option>
                                <?php foreach ($select_estado as $status) {
                                    if ($status['id'] != $estado_id) {
                                        echo '<option value="' . $status['id'] . '"  ' . '>' . $status['nombre'] . '</option>';
                                    }
                                
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="row p-3">
                            <h5 class="mb-4">Horario:*</h5>
                            <div class="form-group col-md-6">
                                <div class="input-group input-time">
                                    <input type="time"  name="hora" class="form-control form-input mb-4" id="hora" value="<?php echo $hora ?>" placeholder=" ">
                                    <label for="hora" class="form-label fw-bold">Hora:*</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group input-daterange" id="datepicker">
                                    <input type="text" required name="fecha" class="form-control form-input mb-4" id="fecha" value="<?php echo $fecha ?>" placeholder=" ">
                                    <label for="fecha" class="form-label fw-bold">Fecha:*</label>
                                    <span class="input-group-append">
                                    <span class="input-group-text bg-transparent border-0">
                                        <i class="bi bi-calendar-minus"></i>
                                    </span>
                                </span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h5 class="mb-4 text-danger">Opcional:</h5>
                        <div class="form-group">
                            <div class="mb-3">
                                <p class="">Observación:</p>
                                <textarea class="form-control" name="observacion" id="observacion" rows="3"><?php echo $observacion ?></textarea>
                            </div>
                        </div>
                        <!--Botones-->
                        <div class="btn-group modal-footer" role="group" aria-label="">
                            <button type="submit" name="actualizar-actividades" id="actualizar-actividades" value="Agregar" class="btn btn-success">Actualizar</button>
                            <a name="limpiar" value="Limpiar" class="btn btn-secondary" onclick="limpiar();">Limpiar</a>
                        </div>
                    </form>
                </div><!--card-body-->
            </div><!--card-->
        </div> <!--col-md-12-->
    </div><!--row-->
</div><!--container-->

<script>
    function limpiar() {
        $("#form-registrarActividades")[0].reset();
        $("#buscarMiembro").focus();
    }

</script>