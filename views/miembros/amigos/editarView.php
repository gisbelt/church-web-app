<?php
/**  @var $this \content\core\View */
$this->title = 'Editar';
?>
<div class="container-fluid">
    <div class="row center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="card">
                <div class="card-header mb-4">
                    <div>
                        <h5 class="p-0 absolute text-center"><?php echo $this->title; ?></h5>
                    </div>
                    <div class="derecha mb-2 p-2 " role="group" aria-label="">
                        <a href="/amigos" class="btn btn-outline-success text-center">Ver listado</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="form-actualizar-amigos"
                          action="/amigos/actualizar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" required name="cedula" class="form-control form-input mb-4"
                                           id="cedula" value="<?php echo $cedula; ?>" placeholder=" " autofocus>
                                    <label for="cedula" class="form-label fw-bold">Cedula:*</label>
                                </div>

                                <div class="form-group">
                                    <input type="text" required name="nombre" class="form-control form-input mb-4"
                                           id="nombre" value="<?php echo $nombre; ?>" placeholder=" ">
                                    <label for="nombre" class="form-label fw-bold">Nombre:*</label>
                                </div>

                                <div class="form-group">
                                    <input type="text" required name="apellido" class="form-control form-input mb-4"
                                           id="apellido" value="<?php echo $apellido; ?>" placeholder=" ">
                                    <label for="apellido" class="form-label fw-bold">Apellido:*</label>
                                </div>

                                <div class="form-group">
                                    <p class="">Sexo:* </p>
                                    <select class="form-select" id="sexo" name="sexo">
                                            <?php
                                            if (1 == $sexo) {
                                                $selected = 'selected';
                                                echo '<option value="'. $sexo . '" ' . $selected . '> Masculino </option>';
                                                echo '<option value="0">Femenino</option>';
                                            } else {
                                                $selected = 'selected';
                                                echo '<option value="1"> Masculino </option>';
                                                echo '<option value="'. $sexo . '" ' . $selected . '>Femenino</option>';
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="id" class="form-control form-input mb-4" id="id" value="<?php echo $id ?>">
                            <!-- ********************** -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" required name="direccion"
                                           class="form-control form-input mb-4" id="direccion"
                                           value="<?php echo $direccion; ?>"
                                           placeholder=" ">
                                    <label for="direccion" class="form-label fw-bold">Dirección:*</label>
                                </div>

                                <div class="form-group">
                                    <input type="text" required name="telefono" class="form-control form-input mb-4"
                                           id="telefono" value="<?php echo $telefono; ?>" placeholder=" ">
                                    <label for="telefono" class="form-label fw-bold">Teléfono:*</label>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-daterange" id="datepicker">
                                        <input type="text" class="form-control form-input mb-4" id="fecha_nacimiento"
                                               name="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>"
                                               placeholder="dd/mm/aaaa">
                                        <label for="fecha_nacimiento" class="form-label fw-bold">Fecha de
                                            Nacimiento:*</label>
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
                                        <?php
                                        switch ($como_llego) {
                                            case '1':
                                                echo '<option value="1" selected>Radio</option>';
                                                echo '<option value="2">Red social</option>';
                                                echo '<option value="3">Miembro</option>';
                                                echo ' <option value="4">Iglesia</option>';
                                                echo '<option value="5">Otros...</option>';
                                                break;
                                            case '2':
                                                echo '<option value="1">Radio</option>';
                                                echo '<option value="2" selected>Red social</option>';
                                                echo '<option value="3">Miembro</option>';
                                                echo ' <option value="4">Iglesia</option>';
                                                echo '<option value="5">Otros...</option>';
                                                break;
                                            case '3':
                                                echo '<option value="1">Radio</option>';
                                                echo '<option value="2">Red social</option>';
                                                echo '<option value="3" selected>Miembro</option>';
                                                echo ' <option value="4">Iglesia</option>';
                                                echo '<option value="5">Otros...</option>';
                                                break;
                                            case '4':
                                                echo '<option value="1">Radio</option>';
                                                echo '<option value="2">Red social</option>';
                                                echo '<option value="3">Miembro</option>';
                                                echo ' <option value="4" selected>Iglesia</option>';
                                                echo '<option value="5">Otros...</option>';
                                                break;
                                            case '5':
                                                echo '<option value="1">Radio</option>';
                                                echo '<option value="2">Red social</option>';
                                                echo '<option value="3">Miembro</option>';
                                                echo ' <option value="4">Iglesia</option>';
                                                echo '<option value="5" selected>Otros...</option>';
                                                break;
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="btn-group modal-footer" role="group" aria-label="">
                            <button type="button" name="actualizar-amigos" id="actualizar-amigos" class="btn btn-success">
                                Actualizar
                            </button>
                            <a name="limpiar" value="Limpiar" class="btn btn-secondary" onclick="limpiar();">Limpiar</a>
                        </div>
                    </form>
                </div><!--card-body-->
            </div><!--card-->
        </div> <!--col-md-12-->
    </div><!--row-->
</div><!--container-->

