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
<div class="row m-0">
    <div class="col-md-8 col-sm-12 col-xs-12">
        <h3 class="text-center mb-4">Listado de usuarios <a href="?url=registrarUsuarios" class="btn btn-success">Nuevo</a></h3>
        <form action="" method="post">
            <div class="mb-4 input-group">
                <input type="text" name="username" id="username" class="form-control" placeholder="Buscar usuario...">
                <span class="input-group-btn">
                    <button type="submit" name="buscar_usuario" class="btn btn-success">Buscar</button>
                </span>                
                <div class="filtro1 derecha ms-1 hidden">
                    <select class="form-control" name="" id="">
                    <option>Seleccionar</option>
                    <option>Líderes</option>
                    <option>Supervisores</option>
                    <option>Miembros</option>
                    </select>
                </div>
                <span class="input-group-btn">
                    <a type="submit" name="" class="btn btn-outline-success ms-1 filtrar" data-number="1">Filtrar</a>
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
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="">
                        <td name="username"></td>
                        <td name="email"></td>
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
</body>
</html>