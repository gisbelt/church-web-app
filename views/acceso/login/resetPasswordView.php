<?php

/**  @var $this \content\core\View */

$this->title = 'Restablecer contraseña'
?>
<div class="containerBackground">
<div class="container">
    <div class="row rowLogin center">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="fw-bold m-0">Resetea tu clave</h5>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="/resetear-contrasena" id="resetear-contrasena-form">
                        <div class="form-group">
                            <input type="password" class="form-control form-input mb-2" name="clave" id="clave" placeholder=" " autocomplete="off">
                            <label for="clave" class="form-label">
                                Escribe tu contraseña:
                                <span class="bi bi-lock"></span>
                            </label>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="password" class="form-control form-input" name="confirmar-clave" id="confirmar-clave" placeholder=" " autocomplete="off">
                            <label for="clave2" class="form-label">
                                Confirmar contraseña:
                                <span class="bi bi-lock"></span>
                            </label>
                            <input type="hidden" class="form-control form-input" name="user" id="user" value="<?php echo  $id ?>"/>
                        </div>
                        <button type="button" name="resetear" id="resetear" class="btn btn-primary w-100 mt-3">Resetear clave</button>
                    </form>
                    <div class="position-relative mb-2 mt-4">
                        <hr class="position-absolute top-0 start-0" width="43%"> 
                        <i class="bi bi-circle lh-lg"></i>
                        <hr class="position-absolute top-0 end-0" width="43%">
                    </div> 
                    <a href="/" class="text-info underline-hover">Iniciar Sesión</a>
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
</div>