<?php 
session_start();
if (file_exists("vendor/autoload.php")) {
	require_once"vendor/autoload.php";
} else {
	if(file_exists("content/component/error500.php")){
		require_once("content/component/error500.php");
	}
	die('<title>Mantenimiento</title>'. $html500);
}

use config\settings\sysConfig as sysConfig;
use content\core\frontController as frontController;

$globalConfig = new sysConfig();
$globalConfig->_int();

$IndexSystem = new frontController($_REQUEST);

