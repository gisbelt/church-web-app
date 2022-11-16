<?php

require_once __DIR__ . "/../vendor/autoload.php";

use content\core\Aplicacion;
use config\settings\sysConfig as sysConfig;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

session_start();
$globalConfig = new sysConfig();
$globalConfig->_int();
$app = new Aplicacion(dirname(__DIR__));
$rutas = rutas();
foreach ($rutas as $key => $ruta) {
    if (empty($ruta->subRutas)) {
        $action = $ruta->action;
        $app->router->$action($ruta->route, [$ruta->controller, $ruta->method]);
    } else {
        foreach ($ruta->subRutas as $subRuta) {
            $action = $subRuta->action;
            $app->router->$action($subRuta->route, [$ruta->controller, $subRuta->method]);
        }
    }
}

$app->run();