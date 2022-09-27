<?php
/**  @var $this \content\core\View */
$this->title = 'Editar';
?>
<div class="container-fluid">
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="card">
                <div class="card-header mb-4">
                    <div>
                        <h5 class="p-0 absolute text-center"><?php echo $this->title; ?></h5>
                    </div>
                    <div class="derecha mb-2 p-2 " role="group" aria-label="">
                        <a href="/usuarios" class="btn btn-outline-success text-center">Ver listado</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" id="form-actualizar-usuario" action="/usuario/actualizar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-input mb-4"
                                           id="username" value="<?php echo $username ?>" autocomplete="off">
                                    <input type="hidden" name="id" class="form-control form-input mb-4"
                                           id="id" value="<?php echo $id ?>" autocomplete="off">
                                    <label for="nombre_permisos" class="form-label fw-bold">Username:*</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control form-input mb-4"
                                           id="email" value="<?php echo $email ?>" autocomplete="off">
                                    <label for="nombre_permisos" class="form-label fw-bold">Email:*</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <p class="">Status:* </p>
                                    <select class="form-select" id="status" name="status">
                                        <?php
                                        if (1 == $status) {
                                            $selected = 'selected';
                                            echo '<option value="'. $status . '" ' . $selected . '> Activo </option>';
                                            echo '<option value="0">Inactivo</option>';
                                        } else {
                                            $selected = 'selected';
                                            echo '<option value="1"> Activo </option>';
                                            echo '<option value="'. $status . '" ' . $selected . '>Inactivo</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="btn-group modal-footer" role="group" aria-label="">
                            <button type="submit" name="actualizar-usuario" id="actualizar-usuario"
                                    class="btn btn-success">Actualizar
                            </button>
                        </div>
                    </form>
                </div><!--card-body-->
            </div><!--card-->
        </div> <!--col-md-12-->
    </div><!--row-->
</div><!--container-->