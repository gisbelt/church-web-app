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
            <form method="POST" id="form-registrar-usuario" action="/usuarios/guardar">
                <div class="form-group">
                    <div class="form-group">
                        <div class="mb-3">
                            <p class="">Miembros:* </p>
                            <select class="form-select" id="miembro" name="miembro">
                                <option value="">selecione miembro</option>
                                <?php foreach ($miembros as $miembro) {
                                    echo '<option value="' . $miembro[miembro] . '">' . $miembro[nombre_completo] . '</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="text" name="username" class="form-control form-input mb-4" id="username" autocomplete="off" required>
                    <label for="username" class="form-label fw-bold">Nombre de usuario:*</label>
                </div>

                <div class="form-group">
                    <input type="text" required name="email" class="form-control form-input mb-4" id="email" autocomplete="off" required>
                    <label for="email" class="form-label fw-bold">Correo:*</label>
                </div>

                <div class="form-group">
                    <input type="password" required name="password" class="form-control form-input mb-4" id="password" autocomplete="off" required>
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

                <div class="form-group">
                    <div class="form-group">
                        <div class="mb-3">
                            <p class="">Asignar rol:* </p>
                            <select class="form-select" id="rol" name="rol">
                                <option value="">selecione rol</option>
                                <?php foreach ($roles as $rol) {
                                    echo '<option value="' . $rol[rol] . '">' . $rol[role_nombre] . '</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <br>
                <div class="btn-group modal-footer" role="group" aria-label="">
                    <button type="button" name="agregar-usuario" id="agregar-usuario" class="btn btn-success"> Agregar </button>
                    <a value="Limpiar" class="btn btn-secondary" onclick="limpiar();"> Limpiar </a>
                </div>
            </form>
        </div><!--card-body-->
    </div> <!--card-->
</div><!--col-->
<!-- ********************************* -->
<script>
    function limpiar() {
        $("#form-registrarUsuarios")[0].reset();
        $("#buscarMiembro").focus();
    }
</script>