<?php
use content\core\Aplicacion;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $this->title; ?></title>
    <?php \content\component\headElement::Heading(); ?>
</head>
<body class="p-0 m-0">
<div class="containerBackground">
    {{content}}
</div>

<!-- ********************************* -->
<?php \content\component\bottomComponent::Bottom(); ?>
</body>
<footer>
    <?php \content\component\footerElement::Footer(); ?>
</footer>
</html>