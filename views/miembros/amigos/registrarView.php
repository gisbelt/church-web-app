<?php
/**  @var $this \content\core\View */

$this->title = 'Registrar Amigos';
?>
<div class="container-fluid">
    <div class="row center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-8">
            <div class="card">
                <div class="card-header mb-4">
                    <div>
                        <h5 class="p-0 absolute text-center">Datos de los amigos</h5>
                    </div>
                    <div class="derecha mb-2 p-2 " role="group" aria-label="">
                        <a href="/amigos" class="btn btn-outline-success text-center">Ver listado</a>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="form-registrarAmigos" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" required name="cedula" class="form-control form-input mb-4"
                                    id="cedula" value="" placeholder=" " autofocus>
                                <label for="cedula" class="form-label fw-bold">Cedula:*</label>
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

                            <div class="form-group">
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
                                    <input type="text" class="form-control form-input mb-4" id="fecha_nacimiento" value="dd/mm/aaaa" placeholder=" ">
                                    <label for="fecha_nacimiento" class="form-label fw-bold">Fecha de Nacimiento:*</label>
                                    <span class="input-group-append">
                                        <span class="input-group-text bg-transparent border-0">
                                            <i class="bi bi-calendar-minus"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="btn-group modal-footer" role="group" aria-label="">
                        <button type="submit" name="agregar" value="Agregar" class="btn btn-success">Agregar</button>
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