<?php
/**  @var $this \content\core\View */

$this->title = 'Registrar donaciones'
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
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
                    <form method="POST" enctype="multipart/form-data" id="form-registrarDonacion" action=""> 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="mb-4 input-group">
                                    <input type="text" name="miembro" id="miembro" class="form-control"
                                        placeholder="Buscar Donante...">
                                    <span class="input-group-btn">
                                        <button type="submit" name="" class="btn btn-secondary">Buscar</button>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="text" required name="miembro" class="form-control form-input mb-4"
                                    id="miembro" value="" placeholder=" ">
                                <label for="miembro" class="form-label fw-bold">Donante:*</label>
                            </div>

                            <div class="form-group">
                                <input type="text" required name="detaller" class="form-control form-input mb-4"
                                    id="detalles" value="" placeholder=" ">
                                <label for="detalles" class="form-label fw-bold">Detalles:*</label>
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
                                <p class="">Tipo Donación:* </p>
                                <select class="form-control" name="" id="">
                                    <option>New Delhi</option>
                                    <option>Istanbul</option>
                                    <option>Jakarta</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="mb-3">
                                    <p class="">Descripción:*</p>
                                    <textarea class="form-control" name="descripcion" id="descripcion"
                                            rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
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
        $("#form-registrarDonacion")[0].reset();
        $("#miembro").focus();
    }

    $(document).ready(function () {
        $("#miembro").focus();
    });
</script>