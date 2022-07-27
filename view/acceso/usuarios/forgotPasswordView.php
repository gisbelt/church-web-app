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
                    Contraseña olvidada
                </div>
                <div class="card-body">
                    <!-- Creamos Formulario: !crt-form-login -->
                    <!-- Enviamos los datos del formulario a través del método post -->
                    <form method="POST" >
                        <div class="form-group">
                            <label for="correo" class="mb-2">Ingresa tu correo para resetear tu clave:</label>
                            <input type="text" class="form-control" name="correo" id="correo" aria-describedby="emailHelp" placeholder="Escribe tu correo">
                        </div>
                        <button type="submit" name="" class="btn btn-primary w-100 mt-3">Continuar</button>
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