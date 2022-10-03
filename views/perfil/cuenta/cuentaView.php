<?php
/**  @var $this \content\core\View */

$this->title = 'Mi Cuenta';
?>
<!-- Menú -->
<div class="container-fluid">
<div class="row center">
    <div class="col-12 col-sm-12 col-md-12 col-lg-6">    
        <div class="card mb-4">
            <div class="card-header">
                <p class="p-0 text-center fw-bold">Administra tu cuenta</p>
            </div>
            <div class="card-body">

                <div class="avatar mb-3" id="avatar">
                    <a id="avatar-link"><i class="bi bi-pencil" id="avatar-pencil"></i></a>
                    <img src="https://i.imgur.com/hczKIze.jpg" alt="">                        
                </div>

                <div class="form-group mb-4">
                    <label for="correo" class="fw-bold mb-1">Correo: </label>
                    <input type="text" disabled class="form-control mb-2 w-50" value="<?php echo $_SESSION['user_email'];?>" id="email" name="email" placeholder="Correo">
                </div>               

                <hr>                
                <h3 class="mb-2 text-first-color">Detalles</h3>

                <div class="form-group">
                    <form method="POST" enctype="multipart/form-data" id="form-username" action="/cuenta/actualizar-nombre">
                    <p  class="fw-bold mb-1">Nombre: </p>
                    <p>
                        <span id="nombre"><?php echo $nombre_completo ?></span>
                        <a class="pointer pencil"><i class="bi bi-pencil"></i></a>
                    </p>
                    <div class="tools">                        
                        <div class="input-group mb-3 w-50">
                            <input type="text" class="form-control mb-2 w-50" value="<?php echo $nombre_completo?>" id="nombre" name="nombre" placeholder="Nombre:">
                            <span class="input-group-btn">
                                <a class="btn btn-success mb-2" value="Cambiar" id="cambiar-nombre">Cambiar</a>
                            </span>
                        </div>
                    </div>
                    </form>
                </div>

                <div class="form-group">
                    <form method="POST" enctype="multipart/form-data" id="form-username" action="/cuenta/actualizar-username">
                    <p  class="fw-bold mb-1">Nombre de usuario: </p>
                    <p>
                        <span id="username"><?php echo $_SESSION['username'] ?></span>
                        <a class="pointer pencil"><i class="bi bi-pencil"></i></a>
                    </p>
                    <div class="tools">
                        <div class="input-group mb-3 w-50">
                            <input type="text" class="form-control mb-2 w-50" value="<?php echo $_SESSION['username'] ?>" id="username" name="username" placeholder="Nombre de usuario:">
                            <span class="input-group-btn">
                                <a class="btn btn-success mb-2" value="Cambiar" id="cambiar-username">Cambiar</a>
                            </span>
                        </div>                        
                    </div>
                    </form>
                </div>

                <div class="form-group">  
                    <form method="POST" enctype="multipart/form-data" id="form-username" action="/cuenta/actualizar-telefono">                      
                    <p class="fw-bold mb-1">Teléfono: </p>
                    <p>
                        <span id="telefono"><?php echo $telefono?></span>
                        <a class="pointer pencil"><i class="bi bi-pencil"></i></a>
                    </p>
                    <div class="tools">
                        <div class="input-group mb-3 w-50">
                            <input type="text" required class="form-control mb-2 w-auto" value="<?php echo $telefono?>" id="telefono" name="telefono" placeholder="Teléfono">
                            <span class="input-group-btn">
                                <a class="btn btn-success mb-2" value="Cambiar" id="cambiar-telefono">Cambiar</a>
                            </span>
                        </div>    
                    </div>
                    </form>
                </div>              

                <div class="form-group">
                    <form method="POST" enctype="multipart/form-data" id="form-username" action="/cuenta/actualizar-direccion"> 
                    <p class="fw-bold mb-1">Dirección:</p>
                    <p>
                        <span id="direccion"><?php echo $direccion?></span>
                        <a class="pointer pencil"><i class="bi bi-pencil"></i></a>
                    </p>
                    <div class="tools">
                        <div class="input-group mb-3">
                            <textarea class="form-control mb-2 " name="direccion" id="direccion" rows="1"><?php echo $direccion?></textarea>
                            <span class="input-group-btn">
                                <a class="btn btn-success mb-2" value="Cambiar" id="cambiar-direccion">Cambiar</a>
                            </span>
                        </div> 
                    </div>
                    </form>
                </div>

            </div><!--card-body-->

            <div class="card-footer bg-light">
                <form method="POST" enctype="multipart/form-data" action="/cuenta/actualizar-contrasena">
                <p class="p-0 text-center fw-bold">Seguridad</p>
                <label for="password" class="fw-bold mb-1">Contraseña: </label>
                <p>
                    <?php
                    $contrasenia = "12345678";
                    $contraseniaReplace = str_repeat('*', strlen($contrasenia) + 5);
                    echo $contraseniaReplace . "\n\n\n";
                    ?>
                    <a class="pointer pencil"><i class="bi bi-pencil"></i></a>
                </p>
                <div class="tools">
                    <div class="form-group">
                        <input type="password" required name="" class="form-control form-input mb-4" id="password" placeholder=" ">
                        <label for="password" class="form-label fw-bold">Contraseña Actual:*</label>
                    </div>

                    <div class="form-group">
                        <input type="password" required name="" class="form-control form-input mb-4" id="password-new" placeholder=" ">
                        <label for="password-new" class="form-label fw-bold">Contraseña Nueva:*</label>
                    </div>

                    <div class="form-group">
                        <input type="password" required name="" class="form-control form-input mb-4" id="password-confirm" placeholder=" ">
                        <label for="password-confirm" class="form-label fw-bold">Confirmar contraseña:*</label>
                    </div>
                </div>
                <br>
                <div class="btn-group derecha mb-3" role="group" aria-label="">
                    <button type="submit" name="guardar_cambios" value="Guardar cambios" class="btn btn-success">Guardar cambios</button>
                </div>   
                </form>             
            </div><!--card-footer-->
        </div><!--card-->    
    </div><!--col-->
</div><!--row-->
</div><!--container-->