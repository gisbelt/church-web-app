<?php
/**  @var $this \content\core\View */

$this->title = 'Registrar Miembros'
?>
<div class="container-fluid">
    <div class="row m-0">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header">
                    <a href="/miembros" class="btn btn-outline-success text-center mt-3">Ver Lista de Miembros</a>
                </div>

                <div class="card-body px-5 pb-5 pt-4">
                    <form method="POST" enctype="multipart/form-data" id="form-registrar-miembros" action="/miembros/guardar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row"> 
                                <div class="col-md-6"> <!-- 1 -->
                                    <div class="form-group">
                                        <input type="text" required name="cedula" class="form-control form-input mb-4" id="cedula" value="" placeholder=" " autofocus autocomplete="off">
                                        <label for="cedula" class="form-label fw-bold">Cedula:*</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" required name="nombre" class="form-control form-input mb-4" id="nombre" value="" placeholder=" " autocomplete="off">
                                        <label for="nombre" class="form-label fw-bold">Nombre:*</label>
                                    </div>                                                                     
                                </div>
                                <div class="col-md-6"> <!-- 2 -->
                                    <div class="form-group">
                                        <input type="text" required name="apellido" class="form-control form-input mb-4" id="apellido" value="" placeholder=" " autocomplete="off">
                                        <label for="apellido" class="form-label fw-bold">Apellido:*</label>
                                    </div>  

                                    <div class="form-group">
                                        <div class="input-group input-daterange" id="datepicker">
                                            <input type="text" class="form-control form-input mb-4" name="fecha_nacimiento" id="fecha_nacimiento"  placeholder=" " autocomplete="off">
                                            <label for="fecha_nacimiento" class="form-label fw-bold">Fecha de Nacimiento:*</label>
                                            <span class="input-group-append">
                                                <span class="input-group-text bg-transparent border-0">
                                                    <i class="bi bi-calendar-minus"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>   
                                <div class="col-md-6"> <!-- 3 -->
                                    <div class="form-group">
                                        <input type="text" required name="telefono" class="form-control form-input mb-4" id="telefono" value="" placeholder=" " autocomplete="off">
                                        <label for="telefono" class="form-label fw-bold">Teléfono:*</label>
                                    </div>                                    
                                </div>                                    
                                <div class="col-md-6"> <!-- 4 -->
                                    <div class="form-group mb-3">
                                        <p class="">Disponibilidad del vehiculo:* </p>
                                        <select class="form-select" name="disponibilidad" id="disponibilidad">
                                            <option value="">Seleccione disponibilidad</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12"> <!-- 1 -->
                                    <div class="form-group">
                                        <input type="text" required name="direccion" class="form-control form-input mb-4" id="direccion" value="" placeholder=" " autocomplete="off">
                                        <label for="direccion" class="form-label fw-bold">Dirección:*</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" required name="grado_instruccion" class="form-control form-input mb-4" id="grado_instruccion" value="" placeholder=" " autocomplete="off">
                                        <label for="grado_instruccion" class="form-label fw-bold">Grado de Instrucción:</label>
                                    </div>

                                    <div class="form-group mb-3">
                                        <p class="">Profesión:* </p>
                                        <select class="form-select" name="profesion" id="profesion">
                                            <option value="">Selecione profesión</option>
                                            <?php foreach ($profesiones as $profesion) {
                                                echo '<option value="' . $profesion[id] . '">' . $profesion[nombre] . '</option>';
                                            } ?>
                                        </select>   
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 mb-4 mb-md-0"> <!-- 1 -->
                                    <p class="">Sexo:* </p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexo" id="femenino" checked>
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

                                <div class="form-group col-md-6 mb-4 mb-md-0"> <!-- 2 -->
                                    <p class="">Vehículo:* </p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="vehiculo" id="si" checked>
                                        <label class="form-check-label" for="si">
                                            Si
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="vehiculo" id="no">
                                        <label class="form-check-label" for="no">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ********************** -->

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group input-daterange" id="datepicker">
                                    <input type="text" class="form-control form-input mb-4" name="fecha_paso_fe" id="fecha_paso_fe" placeholder=" " autocomplete="off">
                                    <label for="fecha_paso_fe" class="form-label fw-bold">Fecha de paso de Fe:*</label>
                                    <span class="input-group-append">
                                        <span class="input-group-text bg-transparent border-0">
                                            <i class="bi bi-calendar-minus"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-daterange" id="datepicker">
                                    <input type="text" class="form-control form-input mb-4" name="fecha_bautismo" id="fecha_bautismo" placeholder=" " autocomplete="off">
                                    <label for="fecha_bautismo" class="form-label fw-bold">Fecha de Bautismo:*</label>
                                    <span class="input-group-append">
                                        <span class="input-group-text bg-transparent border-0">
                                            <i class="bi bi-calendar-minus"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <p class="">Membresía:* </p>
                                <select class="form-select" name="membresia" id="membresia">
                                    <option value="">Seleccione membresías</option>
                                    <?php foreach ($membresias as $membresia) {
                                        echo '<option value="' . $membresia[id] . '">' . $membresia[nombre] . '</option>';
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <p class="">Cargo:* </p>
                                <select class="form-select" name="cargo" id="cargo">
                                    <option value="">Seleccione cargo</option>
                                    <?php foreach ($cargos as $cargo) {
                                        echo '<option value="' . $cargo[id] . '">' . $cargo[nombre] . '</option>';
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="btn-group modal-footer" role="group" aria-label="">
                        <button type="button" name="agregar-miembros" id="agregar-miembros" class="btn btn-success">Agregar</button>
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
        $("#form-registrar-miembros")[0].reset();
        $("#cedula").focus();
    }
</script>