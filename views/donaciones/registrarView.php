<?php
/**  @var $this \content\core\View */

$this->title = 'Registrar donaciones'
?>
<div class="container-fluid">
    <div class="row center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-8">
            <div class="card">
                <div class="card-header mb-4">
                    <div>
                        <h5 class="p-0 absolute text-center">Datos de las donaciones</h5>
                    </div>
                    <div class="derecha mb-2 p-2 " role="group" aria-label="">
                        <a href="/donaciones" class="btn btn-outline-success text-center">Ver
                            listado</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" id="form-registrar-donacion" action="/donaciones/guardar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <p class="">Donante:* </p>
                                    <select class="form-select" id="donante" name="donante">
                                        <option value="">Seleccione un miembro</option>
                                        <?php foreach ($miembros as $miembro) {
                                            echo '<option value="' . $miembro[miembro] . '">' . $miembro[nombre_completo] . '</option>';
                                        } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="text" required name="cantidad" class="form-control form-input mb-4"
                                           id="cantidad" value="" placeholder=" ">
                                    <label for="cantidad" class="form-label fw-bold">Cantidad:</label>
                                </div>
                            </div>
                            <!-- ********************** -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <p class="">Tipo donación:* </p>
                                    <select class="form-select" id="tipo_donacion" name="tipo_donacion">
                                        <option value="">Seleccione tipo de donacion</option>
                                        <?php foreach ($tipo_donaciones as $tipo) {
                                            echo '<option value="' . $tipo[id] . '">' . $tipo[nombre] . '</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <p class="">Detalles:*</p>
                                        <textarea class="form-control" name="detalles" id="detalles"
                                                  rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="btn-group modal-footer" role="group" aria-label="">
                            <button type="button" name="guardar_donacion" id="guardar_donacion" class="btn btn-success">Agregar
                            </button>
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
        $("#form-registrarDonacion")[0].reset();
        $("#buscarMiembro").focus();
    }
</script>