<?php
/**  @var $this \content\core\View */
$this->title = 'Editar donacion';
?>
<div class="container-fluid">
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="card">
                <div class="card-header mb-4">
                    <div>
                        <h5 class="p-0 absolute text-center"><?php echo $this->title; ?></h5>
                    </div>
                    <div class="derecha mb-2 p-2 " role="group" aria-label="">
                        <a href="/donaciones" class="btn btn-outline-success text-center">Ver listado</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" id="form-actualizar-donacion" action="/donacion/actualizar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
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
                                <div class="mb-3">
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
                                        <p class="">Detalle:*</p>
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