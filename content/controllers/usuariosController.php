<?php

namespace content\controllers;

use content\component\headElement as headElement;
use content\component\bottomComponent as bottomComponent;
use content\component\footerElement as footerElement;

use content\core\Controller;
use content\core\middlewares\AutenticacionMiddleware;
use content\models\usuariosModel as usuarios;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Response;

class usuariosController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['create']));
        $this->registerMiddleware(new AutenticacionMiddleware(['consultar']));
        $this->registerMiddleware(new AutenticacionMiddleware(['buscarUsuario']));
    }

    public function index()
    {
        $data['titulo'] = 'Usuarios';
        //return new Response(require_once(realpath(dirname(__FILE__) . './../../views/acceso/usuarios/consultarView.php')), 200);
        $user = usuarios::validarLogin();
        return $this->render('/acceso/usuarios/consultarView');
    }

    public function create()
    {
        /*$data["titulo"] = "Home";*/
        $user = usuarios::validarLogin();
        return $this->render('/acceso/usuarios/registrarView');
    }

    public function consultar()
    {
        $user = usuarios::validarLogin();
        return $this->render('/acceso/usuarios/consultarView');
    }

    public function buscarUsuario(){
        $nombreMiembro = $_POST['buscarMiembro'];
        $consultarMiembro = usuarios::buscarMiembro($nombreMiembro);
        die ($consultarMiembro);
    }
}