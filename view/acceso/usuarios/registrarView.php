<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <?php $head->Heading(); ?>
</head>
<body>
<!-- Menú -->
<?php require_once "content/component/initComponent.php"; ?>
<!-- Menú -->
<div class="offset-md-3 col-md-6">
    <div class="card">
        <div class="card-header mb-4">
            <div>
                <p class="p-0 absolute">Datos de los usuarios</p>
            </div>
            <div class="derecha mb-2 p-2 " role="group" aria-label="">
                <a href="?url=consultarUsuarios" class="btn btn-outline-success text-center">Ver usuarios</a>
            </div>
        </div>

        <div class="card-body">
            <!-- Mensaje de éxito  -->
            <?php if(isset($mensaje1)) { ?>
                <div class="alert alert-primary" role="alert">
                    <?php echo $mensaje1; ?>
                </div>
            <?php }?>

            <form method="POST" enctype="multipart/form-data" id="form-registrarUsuarios">
                
                <div class = "form-group">
                    <div class="mb-4 input-group">
                        <input type="text" name="miembro" id="miembro" class="form-control" placeholder="Buscar miembro...">
                        <span class="input-group-btn">
                            <button type="submit" name="" class="btn btn-secondary">Buscar</button>
                        </span>
                    </div>
                </div>

                <div class = "form-group">
                    <input type="text" required name="cargo" class="form-control form-input mb-4" id="cargo" value="" placeholder=" ">
                    <label for="cargo" class="form-label fw-bold">Cargo:</label>  
                </div>

                <div class = "form-group">
                    <input type="text" required name="username" class="form-control form-input mb-4" id="username" value="" placeholder=" ">
                    <label for="username" class="form-label fw-bold">Nombre de usuario:*</label>  
                </div>

                <div class = "form-group">
                    <input type="text" required name="email" class="form-control form-input mb-4" id="email" value="" placeholder=" ">
                    <label for="email" class="form-label fw-bold">Correo:*</label>
                </div>

                <div class="form-group">
                    <input type="password" required name="password" class="form-control form-input mb-4"  id="password" placeholder=" ">
                    <label for="password" class="form-label fw-bold">Contraseña:*</label>
                </div>

                <div class="form-group">
                    <input type="password" required name="password-confirm" class="form-control form-input mb-4" id="password-confirm" placeholder=" ">
                    <label for="password-confirm" class="form-label fw-bold">Confirmar contraseña:*</label>
                </div>

                <br>
                <div class="btn-group modal-footer" role="group" aria-label="">
                    <button type="submit" name="agregar" value="Agregar" class="btn btn-success">Agregar</button>
                    <a name="limpiar" value="Limpiar" class="btn btn-secondary" onclick="limpiar();">Limpiar</a>
                </div>
            </form>
        </div>

    </div>   
    <br>
</div>
<!-- ********************************* -->

<?php $bottom->Bottom(); ?>
<script>
    function limpiar(){
        $("#form-registrarUsuarios")[0].reset();
        $("#miembro").focus();
    }
    $(document).ready(function(){
        $("#miembro").focus();
    });
</script>
</body>
<footer>
<?php $footer->Footer(); ?>
</footer>
</html>