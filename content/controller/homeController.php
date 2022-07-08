<?php 
namespace content\controller;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\models\adminModel as admin;

$head = new headElement();
$bottom = new bottomComponent();
$footer = new footerElement();

admin::validarLogin();
// sino, si ese usuario tiene un valor, imprime esa información
if($_SESSION['correo']=='ok'){
    $nombreAdmin=$_SESSION['nombreAdmin'];
    $date=$_SESSION['date'];
}

include_once("view/homeView.php");
?>