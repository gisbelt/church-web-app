<?php 
namespace content\controller;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

$head = new headElement();
$bottom = new bottomComponent();
$footer = new footerElement();

header("Cache-control: private");
header("Cache-control: no-cache, must-revalidate");
header("Pragma: no-cache");

include_once("view/usuarios/perfilView.php");
?>