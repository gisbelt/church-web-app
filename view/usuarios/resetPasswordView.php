<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <?php $head->Heading(); ?>
</head>
<body class="">
<!-- Menú -->
<?php require_once "content/component/initComponent.php"; ?>
<!-- Menú -->

<div class="container">
    <div class="row rowLogin center">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Resetea tu clave
                </div>
                <div class="card-body">
                    <!-- Creamos Formulario: !crt-form-login -->
                    <!-- Enviamos los datos del formulario a través del método post -->
                    <form method="POST" >
                        <div class="form-group">
                            <label for="clave">Contraseña:</label>
                            <input type="password" class="form-control" name="" id="" placeholder="Escribe tu contraseña">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="clave">Confirmar contraseña:</label>
                            <input type="password" class="form-control" name="" id="" placeholder="Confirma tu contraseña">
                        </div>
                        <button type="submit" name="" class="btn btn-primary w-100 mt-3">Resetear clave</button>
                    </form>                        
                
                </div>
            </div>
            
        </div>            
    </div>
</div>

<!-- ********************************* -->

<?php $bottom->Bottom(); ?>
</body>
<footer>
<?php $footer->Footer(); ?>
</footer>
</html>