<?php

namespace content\controllers;

use content\core\Controller;
use content\core\middlewares\AutenticacionMiddleware;
use content\models\usuariosModel as usuarios;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class amigosController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['create']));
    }

    public function index()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Amigos';
        //return new Response(require_once(realpath(dirname(__FILE__) . './../../views/miembros/amigos/consultarView.php')), 200);
        return $this->render('/miembros/amigos/consultarView');
    }

    public function create()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Registrar amigos';
        //return new Response(require_once(realpath(dirname(__FILE__) . './../../views/miembros/amigos/registrarView.php')), 200);
        return $this->render('/miembros/amigos/registrarView');
    }

}

?>