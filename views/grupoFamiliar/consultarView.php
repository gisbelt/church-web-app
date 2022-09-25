<?php
$this->title = 'Grupos Familiares';
?>
<div class="container-fluid">
<div class="row center">
    <div class="col-12 col-sm-12 col-md-12 col-lg-8">
        <div class="card mb-5">
            <div class="card-header">
                <h3 class="text-center mt-1"><?php echo $this->title; ?> <a href="/grupo-familiares/create" class="btn btn-success"><i class="bi bi-plus-circle"></i></a></h3>
            </div>
            <div class="card-body center table-wrap">
                <table class="table table-bordered table-striped table-responsive table-hover table-modal w-100" id="grupo-table" data-route="/grupo-familiares/data">
                    <thead class="thead-primary">
                    <tr>
                        <th class="w-auto">Nombre</th>
                        <th class="w-auto">Dirección</th>
                        <th class="w-auto">Líder</th>
                        <th class="w-auto">Zona</th>
                        <th class="text-center w-auto">Acciones</th>
                    </tr>
                    </thead>
                </table>
            </div><!--card-body-->
        </div><!--card-->
    </div><!--col-->
</div><!--row-->
</div><!--container-->

<!-- Modal  -->
<div class="modal fade" id="integrantes" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Amigos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="card p-0">
                            <div class="card-body">
                            <input type="hidden" name="grupo_sid" class="" id="grupo_id">                               
                            <ul class="list-group list-integrantes" id="">
                                <li class="list-group-item bi bi-chevron-right list-li">
                                    Integrantes Uno
                                    <span class="tools"></span>
                                </li>
                                <li class="list-group-item bi bi-chevron-right list-li">
                                    Integrantes Dos
                                    <span class="tools"></span>
                                </li>
                            </ul>
                            </div>
                            <div class="card-footer">
                                <div class="input-group">
                                    <input type="text" name="" id="" class="form-control" placeholder="Buscar Amigo...">
                                    <span class="input-group-btn">
                                    <button type="button" class="btn btn-warning"><i class="bi-plus"></i> Añadir</button>
                                    </span>
                                </div>                
                            </div>
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