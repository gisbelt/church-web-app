<?php
/**  @var $this \content\core\View */
$this->title = 'Editar donacion';
?>
<div class="container-fluid">
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="card mb-5">
                <div class="card-header">
                    <a href="/donaciones" class="btn btn-outline-success text-center mt-3">Ver Lista de Donaciones</a>
                </div>
                <div class="card-body px-5 pb-5 pt-4">
                    <form method="post" enctype="multipart/form-data" id="form-actualizar-donacion" action="/donacion/actualizar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <p class="">Donante:* </p>
                                    <select class="form-select" id="donante" name="donante" disabled>
                                        <?php foreach ($miembros as $miembro) {
                                            if ($miembro == $donante) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                            echo '<option value="' . $miembro[miembro] . '"  ' . $selected . '>' . $miembro[nombre_completo] . '</option>';
                                        } ?>
                                    </select>
                                    <input type="hidden" name="donante" class="form-control form-input mb-4"
                                           value="<?php echo $donante ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <p class="">Tipo donacion:* </p>
                                    <select class="form-select" id="tipo_donacion" name="tipo_donacion" disabled>
                                        <?php foreach ($tipo_donaciones as $tipo_donacion) {
                                            if ($tipo_donacion == $tipo) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                            echo '<option value="' . $tipo_donacion[id] . '" ' . $selected . '>' . $tipo_donacion[nombre] . '</option>';
                                        } ?>
                                    </select>
                                    <input type="hidden" name="tipo_donacion" class="form-control form-input mb-4"
                                            value="<?php echo $tipo ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-3"">
                                    <input type="text" name="cantidad" class="form-control form-input mb-4"
                                           id="cantidad" value="<?php echo $cantidad ?>" autocomplete="off">
                                    <label for="cantidad" class="form-label fw-bold">Cantidad:*</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <p class="">Detalles:*</p>
                                        <textarea class="form-control" name="detalles" id="detalles" rows="3"><?php echo $detalle ?></textarea>
                                        <input type="hidden" name="donacion" class="form-control form-input mb-4"
                                               id="donacion" value="<?php echo $donacion ?>" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="btn-group modal-footer" role="group" aria-label="">
                            <button type="button" name="actualizar-donacion" id="actualizar-donacion"
                                    class="btn btn-success">Actualizar
                            </button>
                        </div>
                    </form>
                </div><!--card-body-->
            </div><!--card-->
        </div> <!--col-md-12-->
    </div><!--row-->
</div><!--container-->