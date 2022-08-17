<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $data["titulo"];  ?></title>
    <?php $head->Heading(); ?>
</head>
<body>
<!-- Menú -->
<?php require_once "content/component/initComponent.php"; ?>
<!-- Menú -->
<div class="row m-0">
<div class="col-md-12">

<div class="card">
    <div class="card-header mb-4">
        <div>
            <h5 class="p-0 absolute text-center">Datos de los miembros</h5>
        </div>
        <div class="derecha mb-2 p-2 " role="group" aria-label="">
            <a href="?url=miembros&action=consultar" class="btn btn-outline-success text-center">Ver listado</a>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" id="form-registrarMiembros">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" required name="cedula" class="form-control form-input mb-4" id="cedula" value="" placeholder=" ">
                            <label for="cedula" class="form-label fw-bold">Cedula:*</label>  
                        </div>

                        <div class="form-group">
                            <input type="text" required name="nombre" class="form-control form-input mb-4" id="nombre" value="" placeholder=" ">
                            <label for="nombre" class="form-label fw-bold">Nombre:*</label>  
                        </div>

                        <div class="form-group">
                            <input type="text" required name="apellido" class="form-control form-input mb-4" id="apellido" value="" placeholder=" ">
                            <label for="apellido" class="form-label fw-bold">Apellido:*</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group input-daterange" id="datepicker">
                                <input type="text" class="form-control form-input mb-4" id="fn" value="" placeholder=" ">
                                <label for="fn" class="form-label fw-bold">Fecha de Nacimiento:*</label>
                                <span class="input-group-append">
                                    <span class="input-group-text bg-transparent border-0">
                                        <i class="bi bi-calendar-minus"></i>
                                    </span>
                                </span>
                            </div>                            
                        </div>

                        <div class="form-group">
                            <input type="text" required name="telefono" class="form-control form-input mb-4" id="telefono" value="" placeholder=" ">
                            <label for="telefono" class="form-label fw-bold">Teléfono:*</label>
                        </div>

                        <div class="form-group">
                            <input type="text" required name="disponibilidad" class="form-control form-input mb-4" id="disponibilidad" value="" placeholder=" ">
                            <label for="disponibilidad" class="form-label fw-bold">Disponibilidad:*</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" required name="direccion" class="form-control form-input mb-4" id="direccion" value="" placeholder=" ">
                            <label for="direccion" class="form-label fw-bold">Dirección:*</label>
                        </div>

                        <div class="form-group">
                            <input type="text" required name="grado_instruccion" class="form-control form-input mb-4" id="grado_instruccion" value="" placeholder=" ">
                            <label for="grado_instruccion" class="form-label fw-bold">Grado de Instrucción:</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group mb-4 col-md-6">
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
                    <div class="form-group mb-4 col-md-6">
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
                        <input type="text" class="form-control form-input mb-4" id="fpf" value="" placeholder=" ">
                        <label for="fpf" class="form-label fw-bold">Fecha de paso de Fe:*</label>
                        <span class="input-group-append">
                            <span class="input-group-text bg-transparent border-0">
                                <i class="bi bi-calendar-minus"></i>
                            </span>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-daterange" id="datepicker">
                        <input type="text" class="form-control form-input mb-4" id="fb" value="" placeholder=" ">
                        <label for="fb" class="form-label fw-bold">Fecha de Bautismo:*</label>
                        <span class="input-group-append">
                            <span class="input-group-text bg-transparent border-0">
                                <i class="bi bi-calendar-minus"></i>
                            </span>
                        </span>
                    </div>                    
                </div>
                <div class="mb-3">
                    <p class="">Membresía:* </p>
                    <select class="form-control" name="" id="">
                    <option>New Delhi</option>
                    <option>Istanbul</option>
                    <option>Jakarta</option>
                    </select>
                </div>
                <div class="mb-3">
                    <p class="">Cargo:* </p>
                    <select class="form-control" name="" id="">
                    <option>New Delhi</option>
                    <option>Istanbul</option>
                    <option>Jakarta</option>
                    </select>
                </div>
                <div class="mb-3">
                    <p class="">Profesión:* </p>
                    <select class="form-control" name="" id="">
                    <option>New Delhi</option>
                    <option>Istanbul</option>
                    <option>Jakarta</option>
                    </select>
                </div>
            </div>
        </div>
        <br>
        <div class="btn-group modal-footer" role="group" aria-label="">
            <button type="submit" name="agregar" value="Agregar" class="btn btn-success">Agregar</button>
            <a name="limpiar" value="Limpiar" class="btn btn-secondary" onclick="limpiar();">Limpiar</a>
        </div>
        </form>
    </div>

</div>   
<br>

</div> <!--col-md-12-->
</div><!--row-->
<!-- ********************************* -->

<?php $bottom->Bottom(); ?>
<script>
    function limpiar(){
        $("#form-registrarMiembros")[0].reset();
        $("#cedula").focus();
    }
    $(document).ready(function(){
        $("#cedula").focus();
    });
</script>
</body>
<footer>
<?php $footer->Footer(); ?>
</footer>
</html>