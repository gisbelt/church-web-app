<?php

/**  @var $this \content\core\View */

$this->title = 'Iniciar sesion'
?>
<div class="container">
<div class="row rowLogin center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header mb-2">
                Iniciar session
            </div>
            <div class="card-body">
                <!-- Creamos Formulario: !crt-form-login -->
                <!-- Enviamos los datos del formulario a través del método post -->
                <form method="post" action="/login" id="login-form" name="login-form">
                    <div class="form-group">
                        <input type="text" class="form-control form-input mb-2" name="email" id="email" aria-describedby="emailHelp" placeholder=" " value="admin@gmail.com" autocomplete="off">
                        <label for="email" class="form-label fw-bold">Correo: <span class="bi bi-envelope"></span></label>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="password" class="form-control form-input mb-2" name="password" id="password" placeholder=" " value="123456" autocomplete="off">
                        <label for="password" class="form-label fw-bold">Contraseña: <span class="bi bi-lock"></span></label>
                    </div>
                    <button type="submit" id="login" name="login" class="btn btn-primary w-100 mt-3">Iniciar Sesión
                    </button>
                </form>
                <div class="position-relative mb-2 mt-4">
                    <hr class="position-absolute top-0 start-0" width="43%"> 
                    <i class="bi bi-circle lh-lg"></i>
                    <hr class="position-absolute top-0 end-0" width="43%">
                </div> 
                <a href="/recuperar-contrasena" class="text-info underline-hover">¿Olvidaste la constraseña?</a>    
            </div>
        </div>
    </div>
</div>
</div>
<!--Waves Container-->
<div>
    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
         viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
        <defs>
            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"/>
        </defs>
        <g class="parallax">
            <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7"/>
            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)"/>
            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)"/>
            <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff"/>
        </g>
    </svg>
</div>
<!--Waves end-->

