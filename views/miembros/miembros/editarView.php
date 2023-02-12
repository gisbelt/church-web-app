<?php
/**  @var $this \content\core\View */

$this->title = 'Editar miembro';
?>
<div class="container-fluid">
    <div class="row m-0">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header">
                    <a href="/miembros" class="btn btn-outline-success text-center mt-3">Ver Lista de Miembros</a>
                </div>

                <div class="card-body px-5 pb-5 pt-4">
                    <form method="POST" enctype="multipart/form-data" id="form-editar-miembro"
                          action="/miembros/actualizar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6"> <!-- 1 -->
                                        <div class="form-group">
                                            <input type="text" required name="cedula"
                                                   class="form-control form-input mb-4" id="cedula"
                                                   value="<?php echo $cedula; ?>" placeholder=" " autofocus
                                                   autocomplete="off">
                                            <label for="cedula" class="form-label fw-bold">Cedula:*</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" required name="nombre"
                                                   class="form-control form-input mb-4" id="nombre"
                                                   value="<?php echo $nombre; ?>" placeholder=" " autocomplete="off">
                                            <label for="nombre" class="form-label fw-bold">Nombre:*</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6"> <!-- 2 -->
                                        <div class="form-group">
                                            <input type="text" required name="apellido"
                                                   class="form-control form-input mb-4" id="apellido"
                                                   value="<?php echo $apellido; ?>" placeholder=" " autocomplete="off">
                                            <label for="apellido" class="form-label fw-bold">Apellido:*</label>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group input-daterange" id="datepicker">
                                                <input type="text" class="form-control form-input mb-4"
                                                       name="fecha_nacimiento" id="fecha_nacimiento"
                                                       value="<?php echo $fecha_nacimiento; ?>" placeholder=" "
                                                       autocomplete="off">
                                                <label for="fecha_nacimiento" class="form-label fw-bold">Fecha de
                                                    Nacimiento:*</label>
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
                                            <input type="text" required name="telefono"
                                                   class="form-control form-input mb-4" id="telefono"
                                                   value="<?php echo $telefono; ?>" placeholder=" " autocomplete="off">
                                            <label for="telefono" class="form-label fw-bold">Teléfono:*</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6"> <!-- 4 -->
                                        <div class="form-group mb-3">
                                            <p class="">Disponibilidad del vehiculo:* </p>
                                            <select class="form-select" name="disponibilidad" id="disponibilidad">
                                                <option value="">Seleccione disponibilidad</option>
                                                <?php
                                                if (1 == $disponibilidad) {
                                                    $selected = 'selected';
                                                    echo '<option value="' . $disponibilidad . '" ' . $selected . '> Si </option>';
                                                    echo '<option value="0">No</option>';
                                                } else {
                                                    $selected = 'selected';
                                                    echo '<option value="1"> Si </option>';
                                                    echo '<option value="' . $disponibilidad . '" ' . $selected . '>No</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12"> <!-- 1 -->
                                        <div class="form-group">
                                            <input type="text" required name="direccion"
                                                   class="form-control form-input mb-4" id="direccion"
                                                   value="<?php echo $direccion; ?>" placeholder=" " autocomplete="off">
                                            <label for="direccion" class="form-label fw-bold">Dirección:*</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" required name="grado_instruccion"
                                                   class="form-control form-input mb-4" id="grado_instruccion"
                                                   value="<?php echo $grado_instruccion; ?>" placeholder=" "
                                                   autocomplete="off">
                                            <label for="grado_instruccion" class="form-label fw-bold">Grado de
                                                Instrucción:</label>
                                        </div>

                                        <div class="form-group mb-3">
                                            <p class="">Profesión:* </p>
                                            <select class="form-select" name="profesion" id="profesion">
                                                <option value="">Selecione profesión</option>
                                                <?php foreach ($profesiones as $profesion) {
                                                    if ($profesion[id] == $profesion_id) {
                                                        $selected = 'selected';
                                                    } else {
                                                        $selected = '';
                                                    }
                                                    echo '<option value="' . $profesion[id] . '" ' . $selected . '>' . $profesion[nombre] . '</option>';
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <p class="">Sexo:* </p>
                                            <select class="form-select" id="sexo" name="sexo">
                                                <?php
                                                if (1 == $sexo) {
                                                    $selected = 'selected';
                                                    echo '<option value="'. $sexo . '" ' . $selected . '> Masculino </option>';
                                                    echo '<option value="0">Femenino</option>';
                                                } else if (0 == $sexo) {
                                                    $selected = 'selected';
                                                    echo '<option value="1"> Masculino </option>';
                                                    echo '<option value="'. $sexo . '" ' . $selected . '>Femenino</option>';
                                                } else {
                                                    echo '<option value="1"> Masculino </option>';
                                                    echo '<option value="0">Femenino</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <p class="">Vehiculo:* </p>
                                            <select class="form-select" id="vehiculo" name="vehiculo">
                                                <?php
                                                if (1 == $vehiculo) {
                                                    $selected = 'selected';
                                                    echo '<option value="'. $vehiculo . '" ' . $selected . '> Si </option>';
                                                    echo '<option value="0">No</option>';
                                                } else if(0 == $vehiculo) {
                                                    $selected = 'selected';
                                                    echo '<option value="1"> Si </option>';
                                                    echo '<option value="'. $vehiculo . '" ' . $selected . '>No</option>';
                                                } else {
                                                    echo '<option value="1"> Si </option>';
                                                    echo '<option value="0">No</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ********************** -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-daterange" id="datepicker">
                                        <input type="text" class="form-control form-input mb-4" name="fecha_paso_fe"
                                               id="fecha_paso_fe" placeholder=" "
                                               value="<?php echo $fecha_paso_de_fe; ?>" autocomplete="off">
                                        <label for="fecha_paso_fe" class="form-label fw-bold">Fecha de paso de
                                            Fe:*</label>
                                        <span class="input-group-append">
                                        <span class="input-group-text bg-transparent border-0">
                                            <i class="bi bi-calendar-minus"></i>
                                        </span>
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-daterange" id="datepicker">
                                        <input type="text" class="form-control form-input mb-4" name="fecha_bautismo"
                                               id="fecha_bautismo" placeholder=" "
                                               value="<?php echo $fecha_bautismo; ?>" autocomplete="off">
                                        <label for="fecha_bautismo" class="form-label fw-bold">Fecha de
                                            Bautismo:*</label>
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
                                            if ($membresia[id] == $membresia_id) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                            echo '<option value="' . $membresia[id] . '" ' . $selected . '>' . $membresia[nombre] . '</option>';
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <p class="">Cargo:* </p>
                                    <select class="form-select" name="cargo" id="cargo">
                                        <option value="">Seleccione cargo</option>
                                        <?php foreach ($cargos as $cargo) {
                                            if ($cargo[id] == $cargo_id) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                            echo '<option value="' . $cargo[id] . '" ' . $selected . '>' . $cargo[nombre] . '</option>';
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <p class="">Status:* </p>
                                        <select class="form-select" id="status" name="status">
                                            <?php
                                            if (1 == $status) {
                                                $selected = 'selected';
                                                echo '<option value="'. $status . '" ' . $selected . '> Activo </option>';
                                                echo '<option value="0">Inactivo</option>';
                                            } else  {
                                                $selected = 'selected';
                                                echo '<option value="1"> Activo </option>';
                                                echo '<option value="'. $status . '" ' . $selected . '>Inactivo</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <input type="hidden" name="miembro" class="form-control form-input mb-4"
                               id="donacion" value="<?php echo $miembro_id ?>" autocomplete="off">
                        <input type="hidden" name="perfil" class="form-control form-input mb-4"
                               id="donacion" value="<?php echo $perfil ?>" autocomplete="off">
                        <div class="btn-group modal-footer" role="group" aria-label="">
                            <button type="button" name="actualizar-miembros" id="actualizar-miembros" class="btn btn-success">
                                Actualizar
                            </button>
                        </div>
                    </form>
                </div><!--card-body-->
            </div><!--card-->
        </div> <!--col-md-12-->
    </div><!--row-->
</div><!--container-->
