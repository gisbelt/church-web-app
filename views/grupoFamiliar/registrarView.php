<?php
/**  @var $this \content\core\View */

$this->title = 'Registrar Grupo Familiar'
?>
<!-- Menú -->
<div class="container-fluid">
    <div class="row center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header mb-4">
                    <div>
                        <h5 class="p-0 absolute text-center">Grupos Familiares</h5>
                    </div>
                    <div class="derecha mb-2 p-2 " role="group" aria-label="">
                        <a href="/grupo-familiares" class="btn btn-outline-success text-center">Ver
                            listado</a>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="form-registrarGrupo" action="">
                        <div class="form-group">
                            <input type="text" name="nombreGrupoFamiliar" class="form-control form-input mb-4"
                                   id="nombreGrupoFamiliar" value="" placeholder=" " autofocus>
                            <label for="nombreGrupoFamiliar" class="form-label fw-bold">Nombre del Grupo
                                Familiar:*</label>
                        </div>

                        <div class="form-group">
                            <div class="mb-4 input-group">
                                <span class="input-group-btn">
                                    <button type="button" name="" class="btn btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#modelId">Ver lista</i></button>
                                </span>
                                <input type="search" name="nombreMiembro" id="miembro" class="form-control"
                                       placeholder="Buscar Miembro..." value="">
                                <span class="input-group-btn">
                                    <a id="add-miembro" class="btn btn-warning add disabled">Añadir <i
                                                class="bi bi-plus-circle"></i></a>
                                </span>
                            </div>
                            <ul class="list-group" id="tabla_resultado"></ul>
                        </div>
                        <div class='new-miembro' id="new-miembro"></div>

                        <br>
                        <div class="btn-group modal-footer" role="group" aria-label="">
                            <button type="button" name="agregar" value="Agregar" id="agregarGrupoFamiliar"
                                    class="btn btn-success" disabled>Agregar
                            </button>
                            <a name="limpiar" value="Limpiar" class="btn btn-secondary" onclick="limpiar();">Limpiar</a>
                        </div>
                    </form>
                </div><!--card-body-->
            </div><!--card-->
        </div> <!--col-md-6-->
    </div><!--row-->
</div><!--container-->
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
                                <?php foreach ($consultarMiembroLista as $m) { ?>
                                    <tr class="miembro_id" data-id="<?php echo $m['idMiembro']; ?>">
                                        <td name="" id=""><?php echo $m['cedula']; ?></td>
                                        <td name="" id="miembroLista"><?php echo $m['nombre'] . ' ';
                                            echo $m['apellido']; ?></td>
                                        <td class="center">
                                            <a id="add" class="btn btn-warning addLista" value=""
                                               data-bs-dismiss="modal">
                                                <i class="bi bi-plus-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
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

<script>
    function limpiar() {
        $("#form-registrarGrupo")[0].reset();
        $("#nombreGrupoFamiliar").focus();
    }      
</script>
