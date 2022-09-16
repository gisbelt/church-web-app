<?php

/**  @var $this \content\core\View */

$this->title = 'Home'
?>
<div class="row jumbotron mb-2 center">
    <div class="col-md-6">
        <br><br>
        <h1 class="display-5">Bienvenido: <i><?php echo $_SESSION['username'] ?></i></h1>
        <p class="lead">Vamos a administrar nuestra Iglesia</p>
        <hr class="my-2">
        <p class="lead mt-3">
            <a class="btn btn-primary btn-lg mb-2" href="/usuarios/create" role="button">Registrar Usuarios</a>
            <a class="btn btn-info btn-lg mb-2" href="/usuarios" role="button">Listado de Usuarios</a>
        </p>
    </div>
</div>
<section class="row">
    <div class="col-md-">
    </div>
</section>