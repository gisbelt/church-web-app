<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $data["titulo"];  ?></title>
    <?php $head->Heading(); ?>
</head>
<body class="p-0">
<div id="body-pd" class="">
    <header class="header p-4" id="header">
        <div class="header_toggle"><i class='bx bx-menu text-bdazzled-blue' id="header-toggle"></i></div>
        <div class="header_img"><img src="asset/img/logo.png" alt=""></div>
        <?php if (isset($user[0])) { ?>
            <div class="dropdown ">
                <button class="btn btn-light dropdown-toggle center" type="button" id="triggerId"
                        data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    <div class="header_img"><img src="https://i.imgur.com/hczKIze.jpg" alt=""></div>
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
                <div class="card-header mb-2">
                    Login
                </div>
                <div class="card-body">

                    <!-- Mensaje de error si el usuario o passwd están vacíos  -->
                    <?php if (isset($mensaje1)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $mensaje1; ?>
                        </div>
                    <?php } ?>

                    <?php if (isset($mensaje2)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $mensaje2; ?>
                        </div>
                    <?php } ?>

                    <!-- Creamos Formulario: !crt-form-login -->
                    <!-- Enviamos los datos del formulario a través del método post -->
                    <form method="POST" action="?url=login&action=iniciar">
                        <div class="form-group">
                            <input type="text" class="form-control form-input mb-2" name="email" id="email" aria-describedby="emailHelp" placeholder=" " value="admin@gmail.com">
                            <label for="email" class="form-label fw-bold">Correo:</label>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="password" class="form-control form-input mb-2" name="password" id="password" placeholder=" " value="123456">
                            <label for="password" class="form-label fw-bold">Contraseña:</label>
                        </div>
                        <br>
                        <a href="?url=login&action=forgotPassword" class="text-info">¿Olvidaste la constraseña?</a>
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