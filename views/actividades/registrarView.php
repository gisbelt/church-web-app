<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $data["titulo"]; ?></title>
    <?php \content\component\headElement::Heading(); ?>
</head>
<body>
<!-- Menú -->
<?php require_once "./../content/component/initComponent.php"; ?>
<!-- Menú -->
<div class="container-fluid">
    <div class="row center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header mb-4">
                    <div>
                        <h5 class="p-0 absolute text-center">Datos de la actividad</h5>
                    </div>
                    <div class="derecha mb-2 p-2 " role="group" aria-label="">
                        <a href="/actividades" class="btn btn-outline-success text-center">Ver listado</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="form-registrarActividades" action="">                     
                    <div class="form-group">
                        <input type="text" required name="nombreActividad" class="form-control form-input mb-4" id="nombreActividad" value="" placeholder=" ">
                        <label for="nombre" class="form-label fw-bold">Nombre de la Actividad:*</label>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <p class="">Descripción:*</p>
                            <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <p class="">Tipo de actividad:* </p>
                        <select class="form-control" name="" id="">
                            <option>Tipo 1</option>
                            <option>Tipo 2</option>
                            <option>Tipo 3</option>
                            <option>Tipo 4</option>
                            <option>Tipo 5 </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <p class="">Estado:* </p>
                        <select class="form-control" name="" id="">
                            <option>En curso</option>
                            <option>Terminada</option>
                            <option>Pausada</option>
                        </select>
                    </div>

                    <div class="row p-3">                      
                        <h5 class="mb-4">Horario:*</h5>
                        <div class="form-group col-md-6">
                            <div class="input-group input-time">
                                <input type="time" required name="hora" class="form-control form-input mb-4" id="hora" value="" placeholder=" ">
                                <label for="hora" class="form-label fw-bold">Hora:*</label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group input-daterange" id="datepicker">
                                <input type="text" required name="fecha" class="form-control form-input mb-4" id="fecha" value="dd/mm/aaaa" placeholder=" ">
                                <label for="fecha" class="form-label fw-bold">Fecha:*</label>
                                <span class="input-group-append">
                                    <span class="input-group-text bg-transparent border-0">
                                        <i class="bi bi-calendar-minus"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>

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
<!-- ********************************* -->

<?php \content\component\bottomComponent::Bottom(); ?>
<script>
    function limpiar() {
        $("#form-registrarActividades")[0].reset();
        $("#nombreActividad").focus();
    }

    $(document).ready(function () {
        $("#nombreActividad").focus();
    });
</script>
</body>
</html>