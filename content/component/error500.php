<?php
ob_start();

require_once("./../../content/controllers/errorController.php");
require_once("./../../views/errorView.php");

$html500 = ob_get_clean();
?>