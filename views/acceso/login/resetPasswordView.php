<?php

/**  @var $this \content\core\View */

$this->title = 'Restablecer contraseña'
?>
    <div class="row rowLogin center">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header mb-2">
                    Resetea tu clave
                </div>
                <div class="card-body">
                    <form method="POST" >
                        <div class="form-group">
                            <input type="password" class="form-control form-input mb-2" name="clave" id="clave" placeholder=" " autocomplete="off">
                            <label for="clave" class="form-label">Escribe tu contraseña:</label>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="password" class="form-control form-input" name="clave" id="clave" placeholder=" " autocomplete="off">
                            <label for="clave" class="form-label">Confirmar contraseña:</label>
                        </div>
                        <button type="submit" name="" class="btn btn-primary w-100 mt-3">Resetear clave</button>
                    </form>

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