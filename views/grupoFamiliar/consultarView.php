<?php
$this->title = 'Grupos Familiares';
?>
<h3 class="text-center mb-4">Listado de Grupos Familiares <a href="/grupo-familiares/create" class="btn btn-success"><i
                class="bi bi-person-plus"></i></a></h3>
<div class="container">
    <div class="row center">
        <div class="col-12 col-sm-12 col-md-4 mb-2 mb-md-0">
            <form action="" method="post">
                <div class="input-group input-daterange" id="datepicker">
                    <span class="input-group-text">                        
                        <i class="bi bi-people text-first-color"></i>
                    </span>
                    <input type="text" name="" id="" class="form-control" placeholder="Buscar...." value="">
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
            <table class="table table-bordered table-striped table-responsive table-hover table-modal w-100">
                <thead class="thead-primary">
                <tr>
                    <th class="text-center w-25">Acciones</th>
                    <th class="w-25">Nombre</th>
                    <th class="w-auto">Integrantes</th>
                </tr>
                </thead>
                <tbody id="myTable">
                <tr>
                    <td >
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
                    <td>Grupo 1 asdsds asdsadsa asdsadsa asdsad</td>
                    <td>
                        <a class="btn btn-link p-0 mb-2 text-first-color" data-bs-toggle="collapse" data-bs-target="#grupo1" aria-expanded="false" aria-controls="collapseExample">Ver Integrantes</a>
                        <ul class="list-group list-group-flush collapse w-50" id="grupo1"">
                            <li class="list-group-item">Item 1 asdsds asdsadsa asdsadsa asdsad</li>
                            <li class="list-group-item">Item 2 asdsds asdsadsa asdsadsa asdsad</li>
                            <li class="list-group-item">Item 3 asdsds asdsadsa asdsadsa asdsad</li>
                        </ul>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // $(document).ready(function () {
    //     $("#miembro").on("keyup", function () {
    //         var value = $(this).val().toLowerCase();
    //         $("#myTable tr").filter(function () {
    //             $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    //         });
    //     });
    // });
</script>