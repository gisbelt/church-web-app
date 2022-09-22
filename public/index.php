<?php
/*
use config\settings\sysConfig as sysConfig;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;


if (file_exists("./../vendor/autoload.php")) {
    require_once "./../vendor/autoload.php";
} else {
    if (file_exists("./../content/component/error500.php")) {
        require_once("./../content/component/error500.php");
    }
    die('<title>Mantenimiento</title>' . $html500);
}
session_start();

use content\models\usuariosModel;

$globalConfig = new sysConfig();
$globalConfig->_int();

$request = Request::createFromGlobals();
$context = new RequestContext();
$context->fromRequest($request);

$rutas = rutas();
$routes = new RouteCollection();
foreach ($rutas as $key => $ruta) {
    if (empty($ruta->subRutas)) {
        $routes->add($ruta->text, new Route($ruta->route, [
            'controller' => $ruta->controller,
            'method' => $ruta->method,
        ]));
    } else {
        foreach ($ruta->subRutas as $subRuta) {
            $routes->add($subRuta->text, new Route($subRuta->route, [
                'controller' => $ruta->controller,
                'method' => $subRuta->method,
            ]));
        }
    }

}

try {
    $matcher = new UrlMatcher($routes, $context);
    $logger = new Logger("web");
    $logger->pushHandler(new StreamHandler(__DIR__ . "./../../Logger/log.txt", Logger::DEBUG));
    $logger->debug(__METHOD__, [$context]);
    $route = $matcher->match($context->getPathInfo());
    $controller = new $route['controller'];
    $method = $route['method'];
    $response = $controller->$method($request);
} catch (ResourceNotFoundException $exception) {
    $response = new Response('Not Found' . $exception, 404);
} catch (\Exception $ex) {
    $response = new Response('An error occurred:' . $ex, 500);
}
http_response_code($response->getStatusCode());
echo $response->getContent();
ob_start();
$response->send();
return ob_get_clean();*/

require_once __DIR__ . "/../vendor/autoload.php";

use content\controllers\AutenticacionController;
use content\controllers\homeController;
use content\core\Aplicacion;
use content\models\usuariosModel as usuarios;
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