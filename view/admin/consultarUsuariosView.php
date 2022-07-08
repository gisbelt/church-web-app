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
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($consulta as $consulta) { ?> 
                    <tr id="proveedor<?php echo $consulta['id_proveedores']; ?>">
                        <td name="nombre_proveedor"><?php echo $consulta['nombre_proveedor'] ?></td>
                        <td name="telefono_proveedor"><?php echo $consulta['telefono_proveedor']; ?></td>
                        <td name="correo_proveedor"><?php echo $consulta['correo_proveedor']; ?></td>
                        <td name="direccion"><?php echo $consulta['direccion']; ?></td>
                        <td>
                            <form method="POST">                            
                                <a href="?url=registrarProveedor&id_proveedores=<?php echo $consulta['id_proveedores'];?>" name="seleccionar" id="seleccionar" class="btn btn-info seleccionar" value="">
                                    <i class="bi bi-pencil text-light"></i>
                                </a>
                                <a name="borrar" id="<?php echo $consulta['id_proveedores']; ?>" class="btn btn-secondary mt-1 borrar_proveedor">
                                    <i class="bi bi-trash text-light"></i>
                                </a>
                            </form>
                        </td>
                    </tr>             
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ********************************* -->
<?php $bottom->Bottom(); ?>
</body>
</html>