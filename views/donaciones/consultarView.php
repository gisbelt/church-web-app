<?php
/**  @var $this \content\core\View */

$this->title = 'Donaciones'
?>
<div class="container-fluid">
    <div class="row center">
        <div class="col-md-10">

            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="text-center mt-1"><?php echo $this->title; ?>
                        <a href="/donaciones/create" class="btn btn-success"><i class="bi bi-plus-circle"></i></a>
                    </h3>
                </div>
                <div class="card-body center table-wrap">
                    <table class="table table-bordered table-striped table-responsive table-hover w-100"
                           id="donaciones-table" data-route="donaciones/data">
                        <thead class="thead-primary">
                        <tr>
                            <th class="w-auto">Detalles</th>
                            <th class="w-auto">Donante</th>
                            <th class="w-auto">Cantidad</th>
                            <th class="w-auto">Disponible</th>
                            <th class="text-center w-auto">Acciones</th>
                        </tr>
                        </thead>
                    </table>
                </div><!--card-body-->
            </div><!--card-->

        </div><!--col-md-8-->
    </div><!--row-->
</div><!--container-->