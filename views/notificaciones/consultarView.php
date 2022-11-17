<?php
/**  @var $this \content\core\View */

$this->title = 'Notificaciones';
?>
<!-- Menú -->
<div class="container-fluid">
    <div class="row center">
        <div class="col-4 col-sm-4 col-md-4 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="mb-2 p-2">
                        <h5 class="p-0 absolute text-center"><?php echo $this->title; ?></h5>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" id="form-registrar-notificacion" action="/notificaciones/crear">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="mesanje" class="form-control form-input mb-4"
                                           id="mesanje" placeholder=" " autocomplete="off">
                                    <label for="mensaje" class="form-label fw-bold">Mensaje:*</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="btn-group modal-footer" role="group" aria-label="">
                            <button type="submit" name="agregar-notificacion" id="agregar-notificacion" class="btn btn-success">Agregar</button>
                        </div>
                    </form>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
            <div class="card mb-3 border-0">
                <div class="card-header bg-white border-0">
                    <h3 class="card-title mt-2 fw-bold">Notificaciones</h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="notificaciones-area">
                            <div class="col-5 control-area">
                                <div class="noti-header p-2 fw-bold list-group list-group-flush">
                                </div>

                                <div class="empty-text">
                                    <p>No tiene notificaciones</p>
                                </div>
                            </div>
                            <div class="col-7 content-area">
                                <!-- <div class="noti-header px-4 pt-4 fw-bold list-group-flush">Actividad próxima</div>
                                <div class="noti-content px-4 text-info">Bautizos a nuevos miembros</div> -->

                                <div class="empty-text">
                                    <p>Seleccione desde la lista lateral de notificaciones para ver más detalles</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /.card -->
        </div><!--col-->
    </div><!--row-->
</div><!--container-->