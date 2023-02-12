<?php
/**  @var $this \content\core\View */
$this->title = 'Editar';
?>
<div class="container-fluid">
    <div class="row center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <a href="/usuarios" class="btn btn-outline-success text-center mt-3">Ver Lista de Usuarios</a>
                </div>
                <div class="card-body px-5 pb-5 pt-4">
                    <form method="post" id="form-actualizar-usuario" action="/usuario/actualizar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-input mb-4" id="username" value="<?php echo $username ?>" placeholder=" " autocomplete="off" required>
                                    <label for="username" class="form-label fw-bold">Nombre de usuario:*</label>
                                    <input type="hidden" name="id" class="form-control form-input mb-4" id="id" value="<?php echo $id ?>" placeholder=" " autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control form-input mb-4" id="email" value="<?php echo $email ?>" placeholder=" " autocomplete="off" required>
                                    <label for="email" class="form-label fw-bold">Email:*</label>
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