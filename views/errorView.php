<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $data["titulo"]; ?></title>
    <?php \content\component\headElement::Heading(); ?>
</head>
<body>
<body class="p-0 m-0">
<div class="p-5 bg-light text-center error_500">
    <div class="container">
        <h1 class="display-3">Sistema en mantenimiento</h1>
        <hr class="my-2">
        <p>Por favor sea paciente</p>
        <p class="lead">
        <h1 class="bi bi-emoji-frown"></h1>
        </p>
    </div>
</div>
<!-- ********************************* -->
<?php \content\component\bottomComponent::Bottom(); ?>
</body>
</html>