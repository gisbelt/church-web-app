<?php
/**  @var $this \content\core\View */

$this->title = 'Registrar Amigos';
?>
<div class="container-fluid">
    <div class="row center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-8">
            <div class="card mb-5">
                <div class="card-header">
                    <a href="/amigos" class="btn btn-outline-success text-center mt-3">Ver Lista de Amigos</a>
                </div>

                <div class="card-body px-5 pb-5 pt-4">
                    <form method="POST" enctype="multipart/form-data" id="form-registrar-amigos" action="/amigo/guardar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" required name="cedula" class="form-control form-input mb-4"
                                    id="cedula" value="" placeholder=" " autofocus>
                                <label for="cedula" class="form-label fw-bold">Cédula:*</label>
                            </div>

                            <div class="form-group">
                                <input type="text" required name="nombre" class="form-control form-input mb-4"
                                    id="nombre" value="" placeholder=" ">
                                <label for="nombre" class="form-label fw-bold">Nombre:*</label>
                            </div>

                            <div class="form-group">
                                <input type="text" required name="apellido" class="form-control form-input mb-4"
                                    id="apellido" value="" placeholder=" ">
                                <label for="apellido" class="form-label fw-bold">Apellido:*</label>
                            </div>

                            <div class="form-group mb-4 mb-md-0">
                                <p class="">Sexo:* </p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sexo" id="femenino"
                                        checked>
                                    <label class="form-check-label" for="femenino">
                                        Femenino
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sexo" id="masculino">
                                    <label class="form-check-label" for="masculino">
                                        Masculino
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- ********************** -->

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" required name="direccion"
                                    class="form-control form-input mb-4" id="direccion" value=""
                                    placeholder=" ">
                                <label for="direccion" class="form-label fw-bold">Dirección:*</label>
                            </div>

                            <div class="form-group">
                                <input type="text" required name="telefono" class="form-control form-input mb-4"
                                    id="telefono" value="" placeholder=" ">
                                <label for="telefono" class="form-label fw-bold">Teléfono:*</label>
                            </div>

                            <div class="form-group">
                                <div class="input-group input-daterange" id="datepicker">
                                    <input type="text" class="form-control form-input mb-4" id="fecha_nacimiento" name="fecha_nacimiento" value="dd/mm/aaaa" placeholder=" ">
                                    <label for="fecha_nacimiento" class="form-label fw-bold">Fecha de Nacimiento:*</label>
                                    <span class="input-group-append">
                                        <span class="input-group-text bg-transparent border-0">
                                            <i class="bi bi-calendar-minus"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <p class="">¿Cómo llegó?:* </p>
                                <select class="form-select" name="como_llego" id="como_llego">
                                    <option value="">Seleccione</option>
                                    <option value="1">Radio</option>
                                    <option value="2">Red social</option>
                                    <option value="3">Miembro</option>
                                    <option value="4">Iglesia</option>
                                    <option value="5">Otros...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="btn-group modal-footer" role="group" aria-label="">
                        <button type="button" name="agregar-amigos" id="agregar-amigos" class="btn btn-success">Agregar</button>
                        <a name="limpiar" value="Limpiar" class="btn btn-secondary" onclick="limpiar();">Limpiar</a>
                    </div>
                    </form>
                </div><!--card-body-->
            </div><!--card-->
        </div> <!--col-md-12-->
    </div><!--row-->
</div><!--container-->

<script>
    function limpiar() {
        $("#form-registrarAmigos")[0].reset();
        $("#cedula").focus();
    }
</script>