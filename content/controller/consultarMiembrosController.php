<?php
namespace content\controller;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\models\usuariosModel as usuarios;

$head = new headElement();
$bottom = new bottomComponent();
$footer = new footerElement();

$user=usuarios::validarLogin();

include_once("view/miembros/miembros/consultarView.php");

?>