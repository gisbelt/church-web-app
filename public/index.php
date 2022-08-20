<?php

use config\settings\sysConfig as sysConfig;
use content\models\usuariosModel as usuarios;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;


if (file_exists("./../vendor/autoload.php")) {
    require_once "./../vendor/autoload.php";
} else {
    if (file_exists("content/component/error500.php")) {
        require_once("content/component/error500.php");
    }
    die('<title>Mantenimiento</title>' . $html500);
}
session_start();
use content\models\usuariosModel;

$globalConfig = new sysConfig();
//$globalConfig->_int();

$request = Request::createFromGlobals();

$context = new RequestContext();
$context->fromRequest($request);

$routes = new RouteCollection();
$routes->add('', new Route('/', ['handler' => function (Request $request) {
    usuarios::validarLogout();
    $data['titulo'] = 'Login';
    return new Response(include_once("./../view/acceso/login/loginView.php"), 200);
}]));

$routes->add('login', new Route('/login', ['handler' => function (Request $request) {
    $email = $request->request->get('email');
    $password = $request->request->get('password');
    usuarios::validarLogout();
    /*$email = $_POST['email'];
    $password = $_POST['password'];*/
    if ($email == "" || $password == "") {
        $mensaje1 = "Por favor debe ingresar los datos";
    } else {
        //ejecutamos
        $consultarUsuario = usuarios::login($email);

        if ($consultarUsuario && $password = $consultarUsuario['password']) {
            $_SESSION['email'] = 'ok';
            $_SESSION['user_email'] = $consultarUsuario->email;
            $_SESSION['username'] = $consultarUsuario->username;
            $_SESSION['date'] = date('d_m_Y_H_i');
            $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
            return new RedirectResponse('/home', 302);
        } else {
            $mensaje2 = "Error, el correo o contraseña son incorrectos";
        }
    }
}]));

$routes->add('logout', new Route('/logout', ['handler' => function (Request $request) {
    session_destroy();
    $data["titulo"] = "Login";
    return new RedirectResponse('/', 302);
}]));


$routes->add('home', new Route('/home', ['handler' => function (Request $request) {
    $user = usuarios::validarLogin();
    $data["titulo"] = "Home";
    return new Response(include_once("./../view/homeView.php"), 200);
}]));

try {
    $matcher = new UrlMatcher($routes, $context);
    $route = $matcher->match($context->getPathInfo());
    $logger = new Logger("web");
    $logger->pushHandler(new StreamHandler(__DIR__."../../Logger/log.txt", Logger::DEBUG));
    $logger->debug(__METHOD__,['route' => $route]);
    $callable = $route['handler'];
    $response = $callable($request);
} catch (ResourceNotFoundException $exception) {
    $response = new Response('Not Found'. $exception, 404);
} catch (\Exception $ex) {
    $response = new Response('An error occurred:'. $ex, 500);
}
http_response_code($response->getStatusCode());
echo $response->getContent();