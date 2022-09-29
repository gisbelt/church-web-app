<?php
/**  @var $this \content\core\View */

$this->title = 'Registrar Grupo Familiar'
?>
<!-- Menú -->
<div class="container-fluid">
    <div class="row center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="card mb-4">
                <div class="card-header mb-4">
                    <div>
                        <h5 class="p-0 absolute text-center">Grupos Familiares</h5>
                    </div>
                    <div class="derecha mb-2 p-2 " role="group" aria-label="">
                        <a href="/grupo-familiares" class="btn btn-outline-success text-center">Ver listado</a>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="form-registrarGrupo" action="/grupo-familiares/guardar">
                        <div class="form-group">
                            <input type="text" name="nombre" class="form-control form-input mb-4" id="nombre" value="" placeholder=" " autofocus>
                            <label for="nombre" class="form-label fw-bold">Nombre del Grupo Familiar:*</label>
                        </div>

                        <div class="form-group">
                            <input type="text" name="direccion" class="form-control form-input mb-4" id="direccion" value="" placeholder=" " autofocus>
                            <label for="direccion" class="form-label fw-bold">Dirección:*</label>
                        </div>

                        <div class="mb-4">
                            <p class="">Lider:* </p>
                            <select class="form-select" id="lider" name="lider">
                                <option value="">Selecione Lider</option>
                                <?php foreach ($lideres as $lider) {
                                    echo '<option value="' . $lider[miembro] . '">' . $lider[nombre_completo] . '</option>';
                                } ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <p class="">Zona:* </p>
                            <select class="form-select" id="zona" name="zona">
                                <option value="">Selecione la Zona</option>
                                <?php foreach ($zonas as $zona) {
                                    echo '<option value="' . $zona[id] . '">' . $zona[nombre] . '</option>';
                                } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <p class="text-first-color">Agregar Amigo: </p>
                            <div class="mb-4 input-group">
                                <span class="input-group-btn">
                                    <button type="button" name="" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#listaAmigos">Ver lista de amigos</i></button>
                                </span>
                                <input type="search" name="nombreAmigo" id="amigo" class="form-control" placeholder="Buscar Amigo..." value="">
                                <span class="input-group-btn">
                                    <a id="add-amigo" class="btn btn-warning add disabled">Añadir <i class="bi bi-plus-circle"></i></a>
                                </span>
                            </div>
                            <ul class="list-group" id="tabla_resultado"></ul>
                        </div>
                        <div class='new-amigo' id="new-amigo"></div>
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
<div class="modal fade" id="listaAmigos" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Amigos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped table-responsive table-hover table-modal w-100" id="amigos-table" data-route="/grupo-familiares/data-amigos">
                                <thead class="thead-primary">
                                <tr>
                                    <th class="w-auto">Cédula</th>
                                    <th class="w-auto">Nombre</th>
                                    <th class="text-center w-auto">Insertar</th>
                                </tr>
                                </thead>
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
