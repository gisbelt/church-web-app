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
    <br>
    <div class="card">
        <div class="card-header">
            <p class="p-0 absolute">Datos de los usuarios</p>
            <div class="derecha mb-2 p-2" role="group" aria-label="">
                <a href="?url=consultarUsuarios" class="btn btn-success text-center">Ver usuarios</a>
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
                    <label for="Cedula" class="fw-bold">Cedula: </label>
                    <input type="text" required class="form-control mb-2" value="" id="cedula" name="cedula" placeholder="Cedula">
                </div>

                <div class = "form-group">
                    <label for="nombre" class="fw-bold">Nombre del usuario: </label>
                    <input type="text" required class="form-control mb-2" value="" id="nombre" name="nombre" placeholder="Nombre">
                </div>

                <div class = "form-group">
                    <label for="correo" class="fw-bold">Correo: </label>
                    <input type="text" required class="form-control mb-2" value="" id="correo" name="correo" placeholder="Correo">
                </div>

                <div class = "form-group">
                    <label for="telefono" class="fw-bold">Teléfono: </label>
                    <input type="text" required class="form-control mb-2" value="" id="telefono" name="telefono" placeholder="Teléfono">
                </div>

                <div class="form-group">
                    <label for="direccion" class="fw-bold">Dirección:</label>
                    <textarea class="form-control mb-2" name="direccion" id="direccion" rows="3"></textarea>
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
        $("#cedula").focus();
    }
    $(document).ready(function(){
        $("#cedula").focus();
    });
</script>
</body>
<footer>
<?php $footer->Footer(); ?>
</footer>
</html>