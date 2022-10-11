<?php

/**  @var $this \content\core\View */

use content\enums\permisos;

$this->title = 'Home'
?>
<div class="container-fluid">
    <div class="row jumbotron mb-2 center">
        <div class="col-md-6">
            <br><br>
            <h1 class="display-5">Bienvenido: <i><?php echo $_SESSION['username'] ?></i></h1>
            <p class="lead">Vamos a administrar nuestra Iglesia</p>
            <hr class="my-2">
            <p class="lead mt-3">
                <?php
                    if (in_array(permisos::$actualizar_actividades, $_SESSION['user_permisos'])) {
                        echo '<a class="btn btn-primary btn-lg mb-2" href="/usuarios/create" role="button">Registrar Usuarios</a>';
                    }
                    if (in_array(permisos::$actualizar_actividades, $_SESSION['user_permisos'])) {
                        echo ' <a class="btn btn-info btn-lg mb-2" href="/usuarios" role="button">Listado de Usuarios</a>';
                    }
                ?>
            </p>
        </div>
    </div>
    <div class="row">
        <!-- left col -->
        <section class="col-lg-6">
            <!-- NOT FINISHED YET -->
        </section>
        <!-- left col -->


        <!-- right col -->
        <section class="col-lg-6"">
            <!-- NOT FINISHED YET -->
        </section>
        <!-- right col -->
    </div>
</div>