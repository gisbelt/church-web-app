<?php
$this->title = 'Configurar Permisos';
?>
<div class="container-fluid">
    <div class="row center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6">

        <div class="card mb-5">
            <div class="card-header bg-white">
                <h3 class="text-center mt-1"><?php echo $this->title; ?> </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="mb-3">
                                <p class="">Seleccione un usuario: </p>
                                <select class="form-select usuario" id="usuario" name="usuario">
                                    
                                </select>
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-6">
                        <div class="form-group rol hidden">
                            <div class="mb-3">
                                <p class="">Rol: </p>
                                <select class="form-select" id="rol" name="rol">
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <p class="">Asignar Permiso: </p>
                            <select class="form-select" id="rol" name="rol">
                                <option value="">Seleccionar Permiso</option>
                                <?php foreach ($permisos as $permiso) {
                                    echo '<option value="' . $permiso[permiso] . '">' . $permiso[permiso_nombre] . '</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <div class="btn-group modal-footer" role="group" aria-label="">
                    <button type="submit" name="agregar-permisos" id="agregar-permisos" class="btn btn-success">Guardar Cambios</button>
                </div>                  
            </div><!--card-body-->
        </div><!--card-->

        </div><!--col-md-8-->
    </div><!--row-->
</div><!--container-->