<?php
/**  @var $this \content\core\View */

$this->title = 'Registrar usuario'
?>
<div class="offset-md-3 col-md-6">
    <div class="card">
        <div class="card-header mb-4">
            <div>
                <p class="p-0 absolute">Datos de los usuarios</p>
            </div>
            <div class="derecha mb-2 p-2 " role="group" aria-label="">
                <a href="/usuarios" class="btn btn-outline-success text-center">Ver usuarios</a>
            </div>
        </div>

        <div class="card-body">
            <!-- Mensaje de éxito  -->
            <?php if (isset($mensaje1)) { ?>
                <div class="alert alert-primary" role="alert">
                    <?php echo $mensaje1; ?>
                </div>
            <?php } ?>

            <form method="POST" enctype="multipart/form-data" id="form-registrarUsuarios" action="">
                <div class="form-group">
                    <div class="mb-4 input-group">
                        <input type="text" name="buscarMiembro" id="buscarMiembro" class="form-control" placeholder="Buscar miembros...">
                        <span class="input-group-btn">
                            <button type="submit" name="" class="btn btn-secondary">Buscar</button>
                        </span>
                    </div>
                    <ul class="list-group" id="tabla_resultado_usuarios"></ul>
                </div>

                <div class="form-group">
                    <input type="text" required name="nombreMiembro" class="form-control form-input mb-4" id="nombreMiembro" value="" placeholder=" ">
                    <label for="nombre" class="form-label fw-bold">Nombre:</label>
                </div>

                <div class="form-group">
                    <input type="text" required name="username" class="form-control form-input mb-4" id="username"
                           value="" placeholder=" ">
                    <label for="username" class="form-label fw-bold">Nombre de usuario:*</label>
                </div>

                <div class="form-group">
                    <input type="text" required name="email" class="form-control form-input mb-4" id="email" value=""
                           placeholder=" ">
                    <label for="email" class="form-label fw-bold">Correo:*</label>
                </div>

                <div class="form-group">
                    <input type="password" required name="password" class="form-control form-input mb-4" id="password"
                           placeholder=" ">
                    <label for="password" class="form-label fw-bold">Contraseña:*</label>
                    <div id="passwordHelpBlock" class="form-text text-danger">
                        Debe tener entre 8 y 20 caracteres.
                    </div>
                </div>

                <div class="form-group">
                    <input type="password" required name="password-confirm" class="form-control form-input mb-4"
                           id="password-confirm" placeholder=" ">
                    <label for="password-confirm" class="form-label fw-bold">Confirmar contraseña:*</label>
                </div>

                <br>
                <div class="btn-group modal-footer" role="group" aria-label="">
                    <button type="submit" name="agregar" value="Agregar" class="btn btn-success">Agregar</button>
                    <a name="limpiar" value="Limpiar" class="btn btn-secondary" onclick="limpiar();">Limpiar</a>
                </div>
            </form>
        </div><!--card-body-->
    </div> <!--card-->
</div><!--col-->
<!-- ********************************* -->
<script>
    function limpiar() {
        $("#form-registrarUsuarios")[0].reset();
        $("#miembro").focus();
    }

    $(document).ready(function () {
        $("#miembro").focus();
    });
</script>