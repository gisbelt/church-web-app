<?php
    
    /**  @var $this \content\core\View */
    
    $this->title = 'Tipos de Actividades'
?>
<div class="container-fluid">
    <div class="row center">
        <div class="col-md-6">
            <div class="card mb-5">
                <div class="card-header">
                    <a href="/actividades" class="btn btn-outline-success text-center mt-3">Ver Lista de Actividades</a>
                </div>
                <div class="card-body px-5 pb-5 pt-4">
                    <form method="POST" enctype="multipart/form-data" id="form-registrarTipoActividades" action="/actividades/storeTipo">
                        <div class="form-group">
                            <input type="text" required name="nombre" class="form-control form-input mb-4" id="nombre" value="" placeholder=" ">
                            <label for="nombre" class="form-label fw-bold">Tipo de  Actividad:*</label>
                        </div>
                        <!--Botones-->
                        <div class="btn-group modal-footer" role="group" aria-label="">
                            <button type="submit" name="agregar" value="Agregar" id="agregar-tipo-actividad" class="btn btn-success">Agregar</button>
                            <a name="limpiar" value="Limpiar" class="btn btn-secondary" onclick="limpiar();">Limpiar</a>
                        </div>
                    </form>
                </div><!--card-body-->
            </div><!--card-->
        </div> <!--col-md-12-->
    </div><!--row-->
</div><!--container-->

<script>
    function limpiar() {
        $("#form-registrarActividades")[0].reset();
        $("#buscarMiembro").focus();
    }

</script>