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
<div class="row m-0 center">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <h3 class="text-center mb-4">Listado de usuarios <a href="?url=registrarUsuarios" class="btn btn-success">Nuevo</a></h3>
        <form action="" method="post">
            <div class="mb-4 input-group">
                <input type="text" name="nombre" id="" class="form-control" placeholder="Buscar usuario...">
                <span class="input-group-btn">
                    <button type="submit" name="buscar_usuario" class="btn btn-success">Buscar</button>
                </span>
            </div>
        </form>     
    </div>    
</div>

<div class=""> <!--container-->
    <div class="row m-0">
        <div class="col-md-12">
            <!-- b4-table-default -->
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th class="text-center">Cedula</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Teléfono</th>                        
                        <th class="text-center">Dirección</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="">
                        <td name="cedula"></td>
                        <td name="nombre"></td>
                        <td name="correo"></td>
                        <td name="telefono"></td>
                        <td name="direccion"></td>
                        <td>
                            <form method="POST" class="center justify-content-evenly">                            
                                <a href="" name="seleccionar" id="seleccionar" class="btn btn-info seleccionar" value="">
                                    <i class="bi bi-pencil text-light"></i>
                                </a>
                                <a href="" name="borrar" id="" class="btn btn-danger">
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
</body>
</html>