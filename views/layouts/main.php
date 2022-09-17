<?php
use content\core\Aplicacion;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $this->title;?></title>
    <?php \content\component\headElement::Heading(); ?>
</head>
<body>
<!-- Menú -->
<?php require_once "./../content/component/initComponent.php"; ?>
<!-- Menú -->
<div class="pt-4">
    {{content}}
</div>
<?php \content\component\bottomComponent::Bottom(); ?>
</body>
</html>