<?php
use content\core\Aplicacion;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $this->title;?></title>
    <?php \content\component\headElement::Heading(); ?>
</head>
<body style="width:100vw;">
<!-- Menú -->
<?php require_once "./../content/component/initComponent.php"; ?>
<!-- Menú -->
    {{content}}
<?php \content\component\bottomComponent::Bottom(); ?>
</body>
</html>