<?php
/**  @var $this \content\core\View */

$this->title = 'Editar Grupo Familiar'
?>
<!-- Menú -->
<div class="container-fluid">
    <div class="row center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-8">
            <div class="card mb-4">
                <div class="card-header mb-4">
                    <div>
                        <h5 class="p-0 absolute text-center">Grupos Familiares</h5>
                    </div>
                    <div class="derecha mb-2 p-2 " role="group" aria-label="">
                        <a href="/grupo-familiares" class="btn btn-outline-success text-center">Ver listado</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="form-actualizarGrupo" action="/grupo-familiares/actualizar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="grupo_id" id="grupo_id" class="form-control form-input mb-4" value="<?php echo $grupo ?>" autocomplete="off">
                                <input type="text" name="nombre" class="form-control form-input mb-4" id="nombre" value="<?php echo $nombre ?>" placeholder=" " autofocus>
                                <label for="nombre" class="form-label fw-bold">Nombre del Grupo Familiar:*</label>
                            </div>

                            <div class="form-group">
                                <input type="text" name="direccion" class="form-control form-input mb-4" id="direccion" value="<?php echo $direccion ?>" placeholder=" " autofocus>
                                <label for="direccion" class="form-label fw-bold">Dirección:*</label>
                            </div>

                            <div class="form-group mb-4">
                                <p class="">Lider:* </p>
                                <select class="form-select" id="lider" name="lider">
                                    <option value="<?php echo $lider_id ?>"><?php echo $lider ?></option>
                                    <?php foreach ($lideres as $lider) {
                                        echo '<option value="' . $lider[miembro] . '">' . $lider[nombre_completo] . '</option>';
                                    } ?>
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <p class="">Zona:* </p>
                                <select class="form-select" id="zona" name="zona">
                                    <option value="<?php echo $zona_id ?>"><?php echo $zona ?></option>
                                    <?php foreach ($zonas as $zona) {
                                        echo '<option value="' . $zona[id] . '">' . $zona[nombre] . '</option>';
                                    } ?>
                            </select>
                            </div>                    
                            <br>
                            <div class="btn-group modal-footer" role="group" aria-label="">
                                <button type="button" name="actualizar-grupo" id="actualizar-grupo"
                                        class="btn btn-success">Actualizar
                                </button>
                            </div>  
                        </div>
                        <!-- ****************** -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="text-first-color">Agregar Amigo: </p>
                                <div class="mb-4">
                                    <button type="button" name="" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#listaAmigos">Ver lista de amigos</i></button>
                                </div>
                            </div>
                            <div class='new-amigo' id="new-amigo"></div>
                            <br>
                            <div class="btn-group modal-footer" role="group" aria-label="">
                                <button type="button" name="agregar-amigo-grupo" id="agregar-amigo-grupo"
                                        class="btn btn-success" disabled>Agregar
                                </button>
                            </div>  
                        </div>                        
                    </div>  
                    </form>              
                </div><!--card-body-->                
            </div><!--card-->
        </div> <!--col-md-6-->
    </div><!--row-->
</div><!--container-->
<!-- ********************************* -->

<!-- Modal  -->
<div class="modal fade" id="listaAmigos" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Amigos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped table-responsive table-hover table-modal w-100" id="amigos-table" data-route="/grupo-familiares/data-amigos">
                                <thead class="thead-primary">
                                <tr>
                                    <th class="w-auto">Cédula</th>
                                    <th class="w-auto">Nombre</th>
                                    <th class="text-center w-auto">Insertar</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
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

<script>
    function limpiar() {
        $("#form-actualizarGrupo")[0].reset();
        $("#nombre").focus();
    }      
</script>
