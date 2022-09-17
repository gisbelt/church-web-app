<?php
use content\core\Aplicacion;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $this->title; ?></title>
    <?php \content\component\headElement::Heading(); ?>
</head>
<body class="p-0 m-0" style="width:100vw;">
<div class="containerBackground">
    <div class="pt-4">
        {{content}}
    </div>
</div>

<!-- ********************************* -->
<?php \content\component\bottomComponent::Bottom(); ?>
</body>
<footer>
    <?php \content\component\footerElement::Footer(); ?>
</footer>
</html>