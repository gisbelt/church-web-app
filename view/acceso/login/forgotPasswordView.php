<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $data["titulo"];  ?></title>
    <?php $head->Heading(); ?>
</head>
<body class="p-0">
<div id="body-pd" class="">
    <header class="header p-4" id="header">
        <div class="header_toggle"> <i class='bx bx-menu text-bdazzled-blue' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="asset/img/logo.png" alt=""> </div>
        <?php if(isset($user[0])){ ?>
        <div class="dropdown ">
            <button class="btn btn-light dropdown-toggle center" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
            </button>
            <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="triggerId">
                <a class="dropdown-item" href="?url=cuenta">Cuenta <i class="bi bi-person text-light"></i> </a>
                <a class="dropdown-item" href="?url=preferencias">Preferencias</a>
                <a class="dropdown-item" href="?url=logout">Cerrar Sesión</a> 
            </div>
        </div>
        <?php } ?>
    </header>
</div>
<div class="container">
    <div class="row rowLogin center">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Clave olvidada
                </div>
                <div class="card-body">
                    <!-- Creamos Formulario: !crt-form-login -->
                    <!-- Enviamos los datos del formulario a través del método post -->
                    <form method="POST" action="">
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