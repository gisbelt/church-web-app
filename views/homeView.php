<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $data["titulo"];  ?></title>
    <?php \content\component\headElement::Heading(); ?>
</head>
<body>
<!-- Menú -->
<?php require_once "./../content/component/initComponent.php"; ?>
<!-- Menú -->

<div class="container-fluid">
    <div class="row jumbotron mb-2 center">
        <div class="col-md-6">
            <br><br>
            <h1 class="display-5">Bienvenido: <i>ADMIN</i></h1>
            <p class="lead">Vamos a administrar nuestra Iglesia</p>
            <hr class="my-2">
            <p class="lead mt-3">
                <a class="btn btn-primary btn-lg mb-2" href="/usuarios/create" role="button">Registrar Usuarios</a>
                <a class="btn btn-info btn-lg mb-2" href="/usuarios" role="button">Listado de Usuarios</a>
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
<!-- ********************************* -->

<?php \content\component\bottomComponent::Bottom(); ?>
</body>
</html>