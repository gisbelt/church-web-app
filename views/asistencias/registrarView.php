<?php
/**  @var $this \content\core\View */

$this->title = 'Registrar asistencia';
?>
<div class="container-fluid">
    <div class="row center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header mb-4">
                    <div>
                        <h5 class="p-0 absolute text-center">Control de Asistencias</h5>
                    </div>
                    <div class="derecha mb-2 p-2 " role="group" aria-label="">
                        <a href="/asistencias" class="btn btn-outline-success text-center">Ver listado</a>
                    </div>
                </div>
                <div class="card-body center">
                    <form method="POST" enctype="multipart/form-data" id="form-registrarAsistencias" action="">  

                    <div class="form-group">
                        <div class="mb-4 input-group">
                            <input type="search" name="nombreActividad" id="nombreActividad" class="form-control" placeholder="Buscar Actividad..." value="">
                            <span class="input-group-btn">
                                <a id="add-actividad" class="btn btn-warning">Añadir <i class="bi bi-plus-circle"></i></a>
                            </span>
                        </div>
                        <ul class="list-group" id="tabla_resultado"></ul>
                    </div>  
                    <table class="table table-bordered table-striped table-responsive table-hover">
                        <thead class="thead-primary">
                        <tr>
                            <th class="">Nombre</th>
                            <th class="">Fecha</th>                 
                            <th class="">Cantidad</th>                 
                        </tr>
                        </thead>
                        <tbody id="myTable">
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input type="text" required name="nombre" class="form-control mb-4" id="nombre" value="" placeholder=" ">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" required name="fecha" class="form-control mb-4" id="fecha" value="" placeholder=" ">
                                </div>
                            </td>  
                            <td>
                                <div class="form-group">
                                    <input type="number" required name="cantidad" class="form-control mb-4 w-auto" id="cantidad" value="" placeholder=" " >
                                </div>
                            </td>               
                        </tr>
                        </tbody>
                    </table>              

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
<script>
    function limpiar() {
        $("#form-registrarAsistencias")[0].reset();
        $("#nombreActividad").focus();
    }

    $(document).ready(function () {
        $("#nombreActividad").focus();
    });
</script>