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

<div class="flex-row center">

    <div class="jumbotron">
        <br><br>
        <h1 class="display-5">Bienvenido: <i><?php echo $nombreAdmin; ?></i></h1>
        <p class="lead">Vamos a administrar nuestra Iglesia</p>
        <hr class="my-2">
        <p class="lead mt-3">
            <a class="btn btn-primary btn-lg" href="?url=registrarUsuarios" role="button">Agregar Miembros</a>
            <a class="btn btn-info btn-lg" href="?url=consultarUsuarios" role="button">Administrar Miembros</a>
        </p>
    </div> 

</div>            
<!-- ********************************* -->

<?php $bottom->Bottom(); ?>
</body>
</html>