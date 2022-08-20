<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $data["titulo"]; ?></title>
    <?php \content\component\headElement::Heading(); ?>
</head>
<body>
<!-- Menú -->
<?php require_once "./../content/component/initComponent.php" ?>
<!-- Menú -->

<div class="flex-row center">

    <div class="jumbotron">
        <br><br>
        <h1 class="display-5">Bienvenido: <i><?php echo $user[0]; ?></i></h1>
        <p class="lead">Vamos a administrar nuestra Iglesia</p>
        <hr class="my-2">
        <p class="lead mt-3">
            <a class="btn btn-primary btn-lg" href="?url=usuarios&action=registrar" role="button">Registrar Usuarios</a>
            <a class="btn btn-info btn-lg" href="?url=usuarios&action=consultar" role="button">Listado de Usuarios</a>
        </p>
    </div>

</div>
<!-- ********************************* -->

<?php \content\component\bottomComponent::Bottom(); ?>
</body>
</html>