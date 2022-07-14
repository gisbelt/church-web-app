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
                    Login
                </div>
                <div class="card-body">

                    <!-- Mensaje de error si el usuario o passwd están vacíos  -->
                    <?php if(isset($mensaje1)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $mensaje1; ?>
                    </div>
                    <?php }?>

                    <?php if(isset($mensaje2)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $mensaje2; ?>
                    </div>
                    <?php }?>

                    <!-- Creamos Formulario: !crt-form-login -->
                    <!-- Enviamos los datos del formulario a través del método post -->
                    <form method="POST" >
                        <div class="form-group">
                            <label for="correo">Correo:</label>
                            <input type="text" class="form-control" name="correo" id="correo" aria-describedby="emailHelp" placeholder="Escribe tu correo">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="clave">Contraseña:</label>
                            <input type="password" class="form-control" name="clave" id="clave" placeholder="Escribe tu contraseña">
                        </div>
                        <br>
                        <a href="?url=forgotPassword" class="text-info">¿Olvidaste la constraseña?</a>
                        <button type="submit" name="login" class="btn btn-primary w-100 mt-2">Iniciar Sesión</button>
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