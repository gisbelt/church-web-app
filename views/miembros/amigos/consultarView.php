<?php
/**  @var $this \content\core\View */

$this->title = 'Amigos';
?>
<h3 class="text-center mb-4">Listado de amigos <a href="/amigos/create" class="btn btn-success"><i class="bi bi-person-plus"></i></a></h3>
<div class="container">
    <div class="row m-0">
        <div class="col-12 col-sm-12 col-md-3 mb-2 mb-md-0">
            <div class="center">
                <label>Sexo:</label>
                <select class="form-control ms-2" id="sexo">
                    <option value="">Todos</option>
                    <option value="">Femenino</option>
                    <option value="">Masculino</option>
                </select>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-7 mb-2 mb-md-0">
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
                    <th class="">Cédula</th>
                    <th class="">Nombre</th>
                    <th class="">Sexo</th>
                    <th class="">Dirección</th>
                    <th class="">Teléfono</th>
                    <th class="">Fecha de Nacimiento</th>                    
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
                    <td name="cedula">22188492</td>
                    <td name="noombre">Gisbel Torres</td>
                    <td name="sexo">Femenino</td>
                    <td name="direccion">Calle 9 Santa Isabel</td>
                    <td name="telefono">04245289570</td>
                    <td name="fn">05/11/2019</td>                    
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#amigo").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>