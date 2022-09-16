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

class donacionesController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AutenticacionMiddleware(['index']));
        $this->registerMiddleware(new AutenticacionMiddleware(['create']));
    }

    public function index()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Donaciones';
        //return new Response(require_once(realpath(dirname(__FILE__) . './../../views/donaciones/consultarView.php')), 200);
        return $this->render('donaciones/consultarView');
    }

    public function create()
    {
        $user = usuarios::validarLogin();
        $data['titulo'] = 'Registrar Donaciones';
        //return new Response(require_once(realpath(dirname(__FILE__) . './../../views/donaciones/registrarView.php')), 200);
        return $this->render('donaciones/registrarView');
    }

}

?>