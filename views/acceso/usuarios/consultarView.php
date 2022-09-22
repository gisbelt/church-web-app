<?php
/**  @var $this \content\core\View */

$this->title = 'Usuarios';
?>
<h3 class="text-center mb-4">Listado de usuarios <a href="/usuarios/create" class="btn btn-success"><i class="bi bi-person-plus"></i></a></h3>
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-3 mb-2 mb-md-0">
            <div class="center">
                <label>Cargo:</label>
                <select class="form-control ms-2" id="location"">
                <option value="">Todos</option>
                <option value="">Lider</option>
                <option value="">Supervisor</option>
                <option value="">Pastor</option>
                </select>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-3 mb-2 mb-md-0">
            <div class="center">
                <label>Estado:</label>
                <select class="form-control ms-2" id="status"">
                <option value="">Todos</option>
                <option value="">Activo</option>
                <option value="">Inactivo</option>
                </select>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-4 mb-2 mb-md-0">
            <form action="" method="post">
                <div class="input-group">
                    <input type="text" name="" id="miembro" class="form-control" placeholder="Nombre...">
                    <span class="input-group-btn">
                    <button type="submit" name="" class="btn btn-secondary">Buscar</button>
                    </span>
                </div>
            </form>
        </div>

        <div class="col-12 col-sm-12 col-md-2 mb-2 mb-md-0">
            <div class="center izquierda">
                <label>Mostrar:</label>
                <select class="form-control ms-2 w-auto" id="per_page">
                    <option>5</option>
                    <option>10</option>
                    <option selected="">15</option>
                    <option>20</option>
                </select>
            </div>
        </div>
    </div>
</div><!--container-->

<div class="container-fluid mt-4"> <!--container-->
    <div class="row">
        <div class="col-md-12 table-wrap">
            <table class="table table-bordered table-striped table-responsive table-hover">
                <thead class="thead-primary">
                <tr>
                    <th class="text-center">Acciones</th>
                    <th class="">Nombre</th>
                    <th class="">Correo</th>
                    <th class="">Cargo</th>
                </tr>
                </thead>
                <tbody id="myTable">
                <tr>
                    <td>
                        <form method="POST" class="center">
                            <a href="" name="seleccionar" id="seleccionar" class="btn btn-info me-2 seleccionar"
                               value="">
                                <i class="bi bi-pencil text-light"></i>
                            </a>
                            <a href="" name="borrar" id="" class="btn btn-danger ms-2">
                                <i class="bi bi-trash text-light"></i>
                            </a>
                        </form>
                    </td>
                    <td name="username">Gisbel</td>
                    <td name="email">gis@gmail.com</td>
                    <td name="cargo">Lider</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#username").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
