<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <?php $head->Heading(); ?>
</head>
<body>
<!-- Menú -->
<?php require_once "content/component/initComponent.php"; ?>
<!-- Menú -->
<br>
<h3 class="text-center mb-4">Listado de usuarios <a href="?url=registrarUsuarios" class="btn btn-success">Nuevo</a></h3>
<div class="container">
<div class="row m-0">
    <div class="col-md-3 col-sm-3 col-xs-3">        
        <div class="flex-row center">
            <label>Cargo:</label>
            <select class="form-control ms-2" id="location""> 
                <option value="">Todos</option>
                <option value="">Lider</option>
                <option value="">Supervisor</option>
                <option value="">Pastor</option>						
            </select>
        </div>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-3">
        <div class="flex-row center">
            <label>Estado:</label>
            <select class="form-control ms-2" id="status"">
                <option value="">Todos</option>
                <option value="">Activo</option>
                <option value="">Inactivo</option>
            </select>
        </div>
    </div>     
    
    <div class="col-md-4 col-sm-4 col-xs-4">
        <form action="" method="post">
            <div class="input-group">
                <input type="text" name="" id="username" class="form-control" placeholder="Nombre...">
                <span class="input-group-btn">
                    <button type="submit" name="" class="btn btn-success">Buscar</button>
                </span> 
            </div>
        </form> 
    </div>  
    
    <div class="col-sm-2 col-sm-2 col-xs-2">
        <div class="filter-group flex-row center">
            <label>Mostrar:</label>
            <select class="form-control ms-2" id="per_page">
                <option>5</option>
                <option>10</option>
                <option selected="">15</option>
                <option>20</option>
            </select>        
        </div>
    </div> 
</div>
</div><!--container-->

<div class="mt-4"> <!--container-->
    <div class="row m-0">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-responsive table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Cargo</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <tr>
                        <td name="username">Gisbel</td>
                        <td name="email">gis@gmail.com</td>
                        <td name="cargo">Lider</td>
                        <td>
                            <form method="POST" class="center">                            
                                <a href="" name="seleccionar" id="seleccionar" class="btn btn-info m-2 seleccionar" value="">
                                    <i class="bi bi-pencil text-light"></i>
                                </a>
                                <a href="" name="borrar" id="" class="btn btn-danger m-2">
                                    <i class="bi bi-trash text-light"></i>
                                </a>
                            </form>
                        </td>
                    </tr> 
                    <tr>
                        <td name="username">Lorena</td>
                        <td name="email">lore@gmail.com</td>
                        <td name="cargo">Supervisor</td>
                        <td>
                            <form method="POST" class="center">                            
                                <a href="" name="seleccionar" id="seleccionar" class="btn btn-info m-2 seleccionar" value="">
                                    <i class="bi bi-pencil text-light"></i>
                                </a>
                                <a href="" name="borrar" id="" class="btn btn-danger m-2">
                                    <i class="bi bi-trash text-light"></i>
                                </a>
                            </form>
                        </td>
                    </tr>              
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ********************************* -->
<?php $bottom->Bottom(); ?>
<script>
    $(document).ready(function(){
        $("#username").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
</body>
</html>