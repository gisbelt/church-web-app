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
<div class="modal fade" id="integrantes" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-route="/grupo-familiares/">
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
                            <?php foreach($integrantes as $integrante) { ?>   
                            <ul class="list-group list-integrantes">
                                <li class="list-group-item bi bi-chevron-right list-li">
                                    <?php echo $integrante['nombre_completo'];?>
                                    <span class="tools"></span>
                                </li>
                            </ul>
                            <?php } ?>
                            </div>
                            <form method="POST" id="form-registrarAmigoGrupo" action="/grupo-familiares/guardar-amigo-grupo">                           
                            <div class="card-footer">
                                <input type="hidden" name="grupo_id" class="" id="grupo_id"> 
                                <div class="mb-4 input-group">
                                    <input type="text" name="nombreAmigo" id="amigo" class="form-control" placeholder="Buscar Amigo...">
                                    <span class="input-group-btn">
                                    <a id="add-amigo" class="btn btn-warning"><i class="bi-plus"></i> Añadir</a>
                                    </span>
                                </div>  
                                <ul class="list-group" id="tabla_resultado"></ul>  
                            </div> 
                            </form>                                       
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