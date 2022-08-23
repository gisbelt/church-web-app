<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $data["titulo"];  ?></title>
    <?php \content\component\footerElement::Footer(); ?>
</head>
<body>
<!-- Menú -->
<?php require_once "content/component/initComponent.php"; ?>
<!-- Menú -->

<div class="container">

<?php \content\component\bottomComponent::Bottom(); ?>

    <div class="row jumbotron mb-2 center">
        <div class="col-md-6">
            <br><br>
            <h1 class="display-5">Bienvenido: <i><?php echo $user[0]; ?></i></h1>
            <p class="lead">Vamos a administrar nuestra Iglesia</p>
            <hr class="my-2">
            <p class="lead mt-3">
                <a class="btn btn-primary btn-lg mb-2" href="?url=usuarios&action=registrar" role="button">Registrar Usuarios</a>
                <a class="btn btn-info btn-lg mb-2" href="?url=usuarios&action=consultar" role="button">Listado de Usuarios</a>
            </p>
        </div>
    </div>

    <!--  -->
    <section class="row">
        <div class="col-md-">
        </div>
    </section>

</div>            
<!-- ********************************* -->

<?php \content\component\bottomComponent::Bottom(); ?>
</body>
</html>