<?php
/**  @var $this \content\core\View */

$this->title = 'Mi Cuenta';
?>
<!-- Menú -->
<div class="offset-md-3 col-md-6">
    
        <div class="card">
            <div class="card-header">
                <p class="p-0 text-center fw-bold">Administra tu cuenta</p>
            </div>

            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" id="form-cuenta" action="">
                <!-- Mensaje de éxito  -->
                <div class="alert alert-primary hidden" role="alert">
                </div>

                <div class="form-group">
                    <div class="avatar mb-3" id="avatar">
                        <a class="editar_perfil" data-number="1" id="avatar-link"><i class="bi bi-pencil" id="avatar-pencil"></i></a>
                        <img src="https://i.imgur.com/hczKIze.jpg" alt="">                        
                    </div>
                    <h4 class="mb-2">
                        Nombre de usuario
                        <a class="pointer editar_perfil" data-number="1"><i class="bi bi-pencil"></i></a>
                    </h4>
                    <div class="show_1 hidden">
                        <input type="text" class="form-control mb-2" value="<?php echo $_SESSION['username'] ?>" id="username" name="username" placeholder="Nombre de usuario:">
                        <a class="btn btn-success mb-2" value="Cambiar" placeholder="Cambiar">Cambiar</a>
                    </div>
                </div>

                <hr>
                
                <div class="form-group">
                    <h4 class="mb-2">Detalles</h4>
                    <label for="telefono" class="fw-bold mb-1">Teléfono: </label>
                    <p class="m-0">
                        04245529755
                        <a class="pointer editar_perfil" data-number="2"><i class="bi bi-pencil"></i></a>
                    </p>
                    <div class="row mt-2">
                        <div class="col-md-3 show_2 hidden">
                            <input type="text" required class="form-control mb-2" value="04245529755" id="telefono" name="telefono" placeholder="Teléfono">
                        </div>
                        <div class="col-md-3 show_2 hidden">
                            <a class="btn btn-success mb-2" value="Cambiar" placeholder="Cambiar">Cambiar</a>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="correo" class="fw-bold mb-1">Correo: </label>
                    <input type="text" disabled class="form-control mb-2" value="" id="email" name="email" placeholder="Correo">
                </div>

                <div class="form-group">
                    <label for="direccion" class="fw-bold mb-1">Dirección:</label>
                    <p>
                        Av. Venezuela con calle 34
                        <a class="pointer editar_perfil" data-number="3"><i class="bi bi-pencil"></i></a>
                    </p>
                    <div class="row mt-2">
                        <div class="col-md-8 show_3 hidden">
                            <textarea class="form-control mb-2" name="direccion" id="direccion" rows="1">Av. Venezuela con calle 34</textarea>
                        </div>
                        <div class="col-md-2 show_3 hidden">
                            <a class="btn btn-success mb-2" value="Cambiar" placeholder="Cambiar">Cambiar</a>
                        </div>
                    </div>
                </div>
                </form>
            </div><!--card-body-->

            <div class="card-footer bg-light">
                <form method="POST" enctype="multipart/form-data" action="">
                <p class="p-0 text-center fw-bold">Seguridad</p>
                <label for="password" class="fw-bold mb-1">Contraseña: </label>
                <p>
                    <?php
                    $contrasenia = "12345678";
                    $contraseniaReplace = str_repeat('*', strlen($contrasenia) + 5);
                    echo $contraseniaReplace . "\n\n\n";
                    ?>
                    <a class="pointer editar_perfil" data-number="4"><i class="bi bi-pencil"></i></a>
                </p>

                <div class="form-group show_4 hidden">
                    <input type="password" required name="" class="form-control form-input mb-4" id="password" placeholder=" ">
                    <label for="password" class="form-label fw-bold">Contraseña Actual:*</label>
                </div>

                <div class="form-group show_4 hidden">
                    <input type="password" required name="" class="form-control form-input mb-4" id="password-new" placeholder=" ">
                    <label for="password-new" class="form-label fw-bold">Contraseña Nueva:*</label>
                </div>

                <div class="form-group show_4 hidden">
                    <input type="password" required name="" class="form-control form-input mb-4" id="password-confirm" placeholder=" ">
                    <label for="password-confirm" class="form-label fw-bold">Confirmar contraseña:*</label>
                </div>
                <br>
                <div class="btn-group derecha mb-3" role="group" aria-label="">
                    <button type="submit" name="guardar_cambios" value="Guardar cambios" class="btn btn-success">Guardar cambios</button>
                </div>   
                </form>             
            </div><!--card-footer-->
        </div><!--card-->    
</div><!--col-->

<script>
    // function limpiar() {
    //     $("#form-cuenta")[0].reset();
    //     $("#username").focus();
    // }

    // $(document).ready(function () {
    //     $("#username").focus();
    // });
</script>