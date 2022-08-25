<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $data["titulo"];  ?></title>
    <?php \content\component\headElement::Heading(); ?>
</head>
<body class="p-0 m-0">
<div class="containerBackground">
    <div class="row rowLogin center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header mb-2">
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
                        <a href="/recuperar-contrasena"  class="text-info text-decoration-underline">¿Olvidaste la constraseña?</a>
                        <button type="submit" name="login" class="btn btn-primary w-100 mt-2">Iniciar Sesión</button>
                    </form>                        
                
                </div>
            </div>
        </div>            
    </div>

    <!--Waves Container-->
    <div>
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
        <defs>
        <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
        </defs>
        <g class="parallax">
        <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
        <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
        <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
        <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
        </g>
        </svg>
    </div>
    <!--Waves end-->

</div>
<!--container ends-->
<!-- ********************************* -->
<?php \content\component\bottomComponent::Bottom(); ?>
</body>
<footer>
<?php \content\component\footerElement::Footer(); ?>
</footer>
</html>