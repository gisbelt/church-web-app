<?php 
namespace content\controller;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\models\adminModel as admin;

$head = new headElement();
$bottom = new bottomComponent();
$footer = new footerElement();

admin::validarLogout();

include_once("view/admin/resetPasswordView.php");   

?>