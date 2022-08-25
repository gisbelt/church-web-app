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
<div class="row m-0 center">
<div class="col-md-6">

<div class="card">
    <div class="card-header mb-4">
        <div>
            <h5 class="p-0 absolute text-center">Grupos Familiares</h5>
        </div>
        <div class="derecha mb-2 p-2 " role="group" aria-label="">
            <a href="?url=grupoFamiliar&action=consultar" class="btn btn-outline-success text-center">Ver listado</a>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" id="form-registrarGrupo">
        <div class = "form-group">
            <input type="text" name="nombre" class="form-control form-input mb-4" id="nombre" value="" placeholder=" ">
            <label for="nombre" class="form-label fw-bold">Nombre del Grupo Familiar:*</label>  
        </div>

        <div class = "form-group">
            <div class="mb-4 input-group">
                <span class="input-group-btn">
                    <button type="button" name="" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modelId">Ver lista</i></button>
                </span>
                <input type="text" name="miembro" id="miembro" class="form-control" placeholder="Buscar Miembro...">
                <span class="input-group-btn">
                    <a id="add" class="btn btn-warning add">Añadir <i class="bi bi-plus-circle"></i></a>
                </span>
            </div>
        </div>

        <div class='new-miembro' id="new-miembro"></div>

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

<!-- Modal  -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Miembros</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped table-responsive table-hover table-modal">
                                <thead class="thead-primary">
                                    <tr>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th class="text-center">Insertar</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <tr id="miembro_id">
                                        <td name="" id="">22188492  </td>
                                        <td name="" id="miembroLista">Gisbel Torres</td>
                                        <td class="center">                                                       
                                            <a id="add" class="btn btn-warning addLista" value="" data-bs-dismiss="modal">
                                                <i class="bi bi-plus-circle"></i>
                                            </a>                             
                                        </td>
                                    </tr>  
                                    <tr id="miembro_id">
                                        <td name="" id="">22188492  </td>
                                        <td name="" id="miembroLista">Lorena Torres</td>
                                        <td class="center">                                                       
                                            <a id="add" class="btn btn-warning addLista" value="" data-bs-dismiss="modal">
                                                <i class="bi bi-plus-circle"></i>
                                            </a>                             
                                        </td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal  -->

<!-- ********************************* -->
<?php $bottom->Bottom(); ?>
<script>
$(document).ready(function(){
    $("#nombre").focus();
    function limpiar(){
        $("#form-registrarGrupo")[0].reset();
        $("#nombre").focus();
    } 

    // Modal 
    var modelId = document.getElementById('modelId');
    modelId.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        let button = event.relatedTarget;
        // Extract info from data-bs-* attributes
        let recipient = button.getAttribute('data-bs-whatever');

        // Use above variables to manipulate the DOM
    });

});
</script>
</body>
</html>