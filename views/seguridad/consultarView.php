<?php
$this->title = 'Lista de Permisos';
?>
<div class="container-fluid mt-4">
    <div class="row">
        <div class="offset-md-2 col-md-8">
            <div class="card">
                <div class="card-header mb-4">
                    <div>
                        <h5 class="p-0 absolute text-center"><?php echo $this->title; ?></h5>
                    </div>
                    <div class="derecha mb-2 p-2" role="group" aria-label="">
                        <a href="/seguridad/crear" class="btn btn-outline-success text-center">Registrar permisos</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-responsive table-hover w-100" id="permisos-table" data-route="/seguridad/permisos-data">
                        <thead class="thead-primary">
                        <tr>
                            <th class="">Nombre</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>